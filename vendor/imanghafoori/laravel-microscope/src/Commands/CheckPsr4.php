<?php

namespace Imanghafoori\LaravelMicroscope\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Composer;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use Imanghafoori\LaravelMicroscope\Analyzers\ComposerJson;
use Imanghafoori\LaravelMicroscope\ErrorReporters\ErrorPrinter;
use Imanghafoori\LaravelMicroscope\Psr4\CheckNamespaces;
use Imanghafoori\LaravelMicroscope\Psr4\ClassRefCorrector;
use Symfony\Component\Console\Terminal;

class CheckPsr4 extends Command
{
    protected $signature = 'check:psr4 {--d|detailed : Show files being checked} {--f|force} {--s|nofix} {--w|watch}';

    protected $description = 'Checks the validity of namespaces';

    public function handle(ErrorPrinter $errorPrinter)
    {
        $this->line('');
        $this->info('Started checking PSR-4 namespaces...');
        $time = microtime(true);

        $errorPrinter->printer = $this->output;

        Event::listen('microscope.checking', function ($path) {
            $this->line('Checking: '.$path);
        });

        Event::listen('laravel_microscope.namespace_fixing', function ($relativePath, $currentNamespace, $correctNamespace, $class) {
            ErrorPrinter::warnIncorrectNamespace($currentNamespace, $relativePath, $class);

            return ! $this->option('nofix') && ErrorPrinter::ask($this, $correctNamespace);
        });

        Event::listen('laravel_microscope.namespace_fixed', function ($relativePath, $from, $to) {
            app(ErrorPrinter::class)->fixedNamespace($relativePath, $to, $from);
        });

        Event::listen('laravel_microscope.psr4.wrong_file_name', function ($path, $class, $file) {
            app(ErrorPrinter::class)->wrongFileName($path, $class, $file);
        });

        Event::listen('microscope.replacing_namespace', function ($_path, $lineIndex, $lineContent) {
            app(ErrorPrinter::class)->printLink($_path, $lineIndex);
            $this->info($lineContent);

            return $this->confirm('Do you want to change the old namespace?', true);
        });

        $this->option('nofix') && config(['microscope.no_fix' => true]);

        $onFix = function ($path, $lineNumber) {
            app(ErrorPrinter::class)->simplePendError('', $path, $lineNumber, 'ns_replacement', 'Namespace replacement:');
        };

        start:
        CheckNamespaces::all($this->option('detailed'));
        ClassRefCorrector::fixAllRefs($onFix);

        app(ErrorPrinter::class)->logErrors();
        $this->printReport($errorPrinter, $time);

        $this->composerDumpIfNeeded($errorPrinter);
        if ($this->option('watch')) {
            sleep(8);

            CheckNamespaces::reset();
            app(ErrorPrinter::class)->errorsList = ['total' => 0];

            goto start;
        }
    }

    private function composerDumpIfNeeded(ErrorPrinter $errorPrinter)
    {
        if ($c = $errorPrinter->getCount('badNamespace')) {
            $this->output->write('- '.$c.' Namespace'.($c > 1 ? 's' : '').' Fixed, Running: "composer dump"');
            app(Composer::class)->dumpAutoloads();
            $this->info("\n".'finished: "composer dump"');
        }
    }

    private function printErrorsCount($errorPrinter, $time)
    {
        if ($errorCount = $errorPrinter->errorsList['total']) {
            $this->warn(PHP_EOL.$errorCount.' error(s) found.');
        } else {
            $this->noErrorFound($time);
        }
    }

    private function reportResult()
    {
        $this->getOutput()->writeln('');
        $this->getOutput()->writeln('<fg=blue>Finished!</>');
        $separator = function ($color) {
            $this->info(' <fg='.$color.'>'.str_repeat('_', (new Terminal)->getWidth() - 2).'</>');
        };

        try {
            $separator('gray');
        } catch (\Exception $e) {
            $separator('blue');
        }
        $this->getOutput()->writeln('<options=bold;fg=yellow>'.CheckNamespaces::$checkedNamespaces.' classes were checked under:</>');
        $len = 0;
        foreach (ComposerJson::readAutoload() as $composerPath => $psr4) {
            $output = '';
            $this->getOutput()->writeln(' <fg=blue>./'.trim($composerPath.'/', '/').'composer.json'.'</>');
            foreach ($psr4 as $namespace => $path) {
                $max = max($len, strlen($namespace));
                $len = strlen($namespace);
                $output .= '   - <fg=red>'.$namespace.str_repeat(' ', $max - strlen($namespace)).' </> (<fg=green>./'.$path."</>)\n";
            }
            $this->getOutput()->writeln($output);
        }
    }

    private function noErrorFound($time)
    {
        $time = microtime(true) - $time;
        $this->line(PHP_EOL.'<fg=green>All namespaces are correct!</><fg=blue> You rock  \(^_^)/ </>');
        $this->line('<fg=red;options=bold>'.round($time, 5).'(s)</>');
        $this->line('');
    }

    private function printReport($errorPrinter, $time)
    {
        if (! $this->option('watch') && Str::startsWith(request()->server('argv')[1] ?? '', 'check:psr4')) {
            $this->reportResult();
            $this->printErrorsCount($errorPrinter, $time);
        } else {
            $this->getOutput()->writeln(' - '.CheckNamespaces::$checkedNamespaces.' namespaces were checked.');
        }
    }
}
