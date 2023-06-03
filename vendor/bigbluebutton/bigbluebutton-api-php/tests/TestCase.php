<?php

/*
 * BigBlueButton open source conferencing system - https://www.bigbluebutton.org/.
 *
 * Copyright (c) 2016-2022 BigBlueButton Inc. and by respective authors (see below).
 *
 * This program is free software; you can redistribute it and/or modify it under the
 * terms of the GNU Lesser General Public License as published by the Free Software
 * Foundation; either version 3.0 of the License, or (at your option) any later
 * version.
 *
 * BigBlueButton is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
 * PARTICULAR PURPOSE. See the GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License along
 * with BigBlueButton; if not, see <http://www.gnu.org/licenses/>.
 */

namespace BigBlueButton;

use BigBlueButton\Core\GuestPolicy;
use BigBlueButton\Core\MeetingLayout;
use BigBlueButton\Parameters\CreateMeetingParameters;
use BigBlueButton\Parameters\EndMeetingParameters;
use BigBlueButton\Parameters\JoinMeetingParameters;
use BigBlueButton\Parameters\UpdateRecordingsParameters;
use BigBlueButton\Responses\CreateMeetingResponse;
use BigBlueButton\Responses\UpdateRecordingsResponse;
use Faker\Factory as Faker;
use Faker\Generator;

/**
 * Class TestCase.
 *
 * @internal
 * @coversNothing
 */
class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * @var Generator
     */
    protected $faker;

    /**
     * {@inheritdoc}
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->faker = Faker::create();
    }

    // Additional assertions

    public function assertIsInteger($actual, $message = '')
    {
        if (empty($message)) {
            $message = 'Got a ' . gettype($actual) . ' instead of an integer.';
        }
        $this->assertTrue(is_integer($actual), $message);
    }

    public function assertIsDouble($actual, $message = '')
    {
        if (empty($message)) {
            $message = 'Got a ' . gettype($actual) . ' instead of a double.';
        }
        $this->assertTrue(is_double($actual), $message);
    }

    public function assertIsBoolean($actual, $message = '')
    {
        if (empty($message)) {
            $message = 'Got a ' . gettype($actual) . ' instead of a boolean.';
        }
        $this->assertTrue(is_bool($actual), $message);
    }

    public function assertEachGetterValueIsString($obj, $getters)
    {
        foreach ($getters as $getterName) {
            $this->assertIsString($obj->{$getterName}(), 'Got a ' . gettype($obj->{$getterName}()) . ' instead of a string for property -> ' . $getterName);
        }
    }

    public function assertEachGetterValueIsInteger($obj, $getters)
    {
        foreach ($getters as $getterName) {
            $this->assertIsInteger($obj->{$getterName}(), 'Got a ' . gettype($obj->{$getterName}()) . ' instead of an integer for property -> ' . $getterName);
        }
    }

    public function assertEachGetterValueIsDouble($obj, $getters)
    {
        foreach ($getters as $getterName) {
            $this->assertIsDouble($obj->{$getterName}(), 'Got a ' . gettype($obj->{$getterName}()) . ' instead of a double for property -> ' . $getterName);
        }
    }

    public function assertEachGetterValueIsBoolean($obj, $getters)
    {
        foreach ($getters as $getterName) {
            $this->assertIsBoolean($obj->{$getterName}(), 'Got a ' . gettype($obj->{$getterName}()) . ' instead of a boolean for property -> ' . $getterName);
        }
    }

    /**
     * @param $bbb BigBlueButton
     *
     * @return CreateMeetingResponse
     */
    protected function createRealMeeting($bbb)
    {
        $createMeetingParams = $this->generateCreateParams();
        $createMeetingMock   = $this->getCreateMock($createMeetingParams);

        return $bbb->createMeeting($createMeetingMock);
    }

    /**
     * @return array
     */
    protected function generateCreateParams()
    {
        return [
            'meetingName'                            => $this->faker->name,
            'meetingId'                              => $this->faker->uuid,
            'attendeePassword'                       => $this->faker->password,
            'moderatorPassword'                      => $this->faker->password,
            'autoStartRecording'                     => $this->faker->boolean(50),
            'dialNumber'                             => $this->faker->phoneNumber,
            'voiceBridge'                            => $this->faker->randomNumber(5),
            'webVoice'                               => $this->faker->word,
            'logoutUrl'                              => $this->faker->url,
            'maxParticipants'                        => $this->faker->numberBetween(2, 100),
            'record'                                 => $this->faker->boolean(50),
            'duration'                               => $this->faker->numberBetween(0, 6000),
            'welcomeMessage'                         => $this->faker->sentence,
            'allowStartStopRecording'                => $this->faker->boolean(50),
            'moderatorOnlyMessage'                   => $this->faker->sentence,
            'webcamsOnlyForModerator'                => $this->faker->boolean(50),
            'logo'                                   => $this->faker->imageUrl(330, 70),
            'copyright'                              => $this->faker->text,
            'muteOnStart'                            => $this->faker->boolean(50),
            'lockSettingsDisableCam'                 => $this->faker->boolean(50),
            'lockSettingsDisableMic'                 => $this->faker->boolean(50),
            'lockSettingsDisablePrivateChat'         => $this->faker->boolean(50),
            'lockSettingsDisablePublicChat'          => $this->faker->boolean(50),
            'lockSettingsDisableNote'                => $this->faker->boolean(50),
            'lockSettingsHideUserList'               => $this->faker->boolean(50),
            'lockSettingsLockedLayout'               => $this->faker->boolean(50),
            'lockSettingsLockOnJoin'                 => $this->faker->boolean(50),
            'lockSettingsLockOnJoinConfigurable'     => $this->faker->boolean(50),
            'allowModsToUnmuteUsers'                 => $this->faker->boolean(50),
            'allowModsToEjectCameras'                => $this->faker->boolean(50),
            'guestPolicy'                            => $this->faker->randomElement([GuestPolicy::ALWAYS_ACCEPT, GuestPolicy::ALWAYS_DENY, GuestPolicy::ASK_MODERATOR]),
            'endWhenNoModerator'                     => $this->faker->boolean(50),
            'endWhenNoModeratorDelayInMinutes'       => $this->faker->numberBetween(1, 30),
            'meetingKeepEvents'                      => $this->faker->boolean(50),
            'learningDashboardEnabled'               => $this->faker->boolean(50),
            'learningDashboardCleanupDelayInMinutes' => $this->faker->numberBetween(1, 30),
            'bannerText'                             => $this->faker->sentence,
            'bannerColor'                            => $this->faker->hexColor,
            'breakoutRoomsEnabled'                   => $this->faker->boolean(50),
            'breakoutRoomsRecord'                    => $this->faker->boolean(50),
            'breakoutRoomsPrivateChatEnabled'        => $this->faker->boolean(50),
            'meetingEndedURL'                        => $this->faker->url,
            'meetingLayout'                          => $this->faker->randomElement([MeetingLayout::CUSTOM_LAYOUT, MeetingLayout::SMART_LAYOUT, MeetingLayout::PRESENTATION_FOCUS, MeetingLayout::VIDEO_FOCUS]),
            'meta_presenter'                         => $this->faker->name,
            'meta_endCallbackUrl'                    => $this->faker->url,
            'meta_bbb-recording-ready-url'           => $this->faker->url,
        ];
    }

    /**
     * @param $createParams
     *
     * @return array
     */
    protected function generateBreakoutCreateParams($createParams)
    {
        return array_merge($createParams, [
            'isBreakout'      => true,
            'parentMeetingId' => $this->faker->uuid,
            'sequence'        => $this->faker->numberBetween(1, 8),
            'freeJoin'        => $this->faker->boolean(50),
        ]);
    }

    /**
     * @param $params array
     *
     * @return CreateMeetingParameters
     */
    protected function getCreateMock($params)
    {
        $createMeetingParams = new CreateMeetingParameters($params['meetingId'], $params['meetingName']);

        return $createMeetingParams
            ->setAttendeePassword($params['attendeePassword'])
            ->setModeratorPassword($params['moderatorPassword'])
            ->setDialNumber($params['dialNumber'])
            ->setVoiceBridge($params['voiceBridge'])
            ->setWebVoice($params['webVoice'])
            ->setLogoutUrl($params['logoutUrl'])
            ->setMaxParticipants($params['maxParticipants'])
            ->setRecord($params['record'])
            ->setDuration($params['duration'])
            ->setWelcomeMessage($params['welcomeMessage'])
            ->setAutoStartRecording($params['autoStartRecording'])
            ->setAllowStartStopRecording($params['allowStartStopRecording'])
            ->setModeratorOnlyMessage($params['moderatorOnlyMessage'])
            ->setWebcamsOnlyForModerator($params['webcamsOnlyForModerator'])
            ->setLogo($params['logo'])
            ->setCopyright($params['copyright'])
            ->setEndCallbackUrl($params['meta_endCallbackUrl'])
            ->setMuteOnStart($params['muteOnStart'])
            ->setLockSettingsDisableCam($params['lockSettingsDisableCam'])
            ->setLockSettingsDisableMic($params['lockSettingsDisableMic'])
            ->setLockSettingsDisablePrivateChat($params['lockSettingsDisablePrivateChat'])
            ->setLockSettingsDisablePublicChat($params['lockSettingsDisablePublicChat'])
            ->setLockSettingsDisableNote($params['lockSettingsDisableNote'])
            ->setLockSettingsHideUserList($params['lockSettingsHideUserList'])
            ->setLockSettingsLockedLayout($params['lockSettingsLockedLayout'])
            ->setLockSettingsLockOnJoin($params['lockSettingsLockOnJoin'])
            ->setLockSettingsLockOnJoinConfigurable($params['lockSettingsLockOnJoinConfigurable'])
            ->setEndWhenNoModerator($params['endWhenNoModerator'])
            ->setEndWhenNoModeratorDelayInMinutes($params['endWhenNoModeratorDelayInMinutes'])
            ->setAllowModsToUnmuteUsers($params['allowModsToUnmuteUsers'])
            ->setAllowModsToEjectCameras($params['allowModsToEjectCameras'])
            ->setGuestPolicy($params['guestPolicy'])
            ->setMeetingKeepEvents($params['meetingKeepEvents'])
            ->setLearningDashboardEnabled($params['learningDashboardEnabled'])
            ->setLearningDashboardCleanupDelayInMinutes($params['learningDashboardCleanupDelayInMinutes'])
            ->setBannerColor($params['bannerColor'])
            ->setBannerText($params['bannerText'])
            ->setBreakoutRoomsEnabled($params['breakoutRoomsEnabled'])
            ->setBreakoutRoomsRecord($params['breakoutRoomsRecord'])
            ->setBreakoutRoomsPrivateChatEnabled($params['breakoutRoomsPrivateChatEnabled'])
            ->setMeetingEndedURL($params['meetingEndedURL'])
            ->setMeetingLayout($params['meetingLayout'])
            ->addMeta('presenter', $params['meta_presenter'])
            ->addMeta('bbb-recording-ready-url', $params['meta_bbb-recording-ready-url'])
        ;
    }

    /**
     * @param $params
     *
     * @return CreateMeetingParameters
     */
    protected function getBreakoutCreateMock($params)
    {
        $createMeetingParams = $this->getCreateMock($params);

        return $createMeetingParams->setBreakout($params['isBreakout'])->setParentMeetingId($params['parentMeetingId'])->
        setSequence($params['sequence'])->setFreeJoin($params['freeJoin']);
    }

    /**
     * @return array
     */
    protected function generateJoinMeetingParams()
    {
        return ['meetingId'        => $this->faker->uuid,
            'userName'             => $this->faker->name,
            'password'             => $this->faker->password,
            'userId'               => $this->faker->numberBetween(1, 1000),
            'webVoiceConf'         => $this->faker->word,
            'creationTime'         => $this->faker->unixTime,
            'userdata_countrycode' => $this->faker->countryCode,
            'userdata_email'       => $this->faker->email,
            'userdata_commercial'  => false,
        ];
    }

    /**
     * @param $params array
     *
     * @return JoinMeetingParameters
     */
    protected function getJoinMeetingMock($params)
    {
        $joinMeetingParams = new JoinMeetingParameters($params['meetingId'], $params['userName'], $params['password']);

        return $joinMeetingParams->setUserId($params['userId'])->setWebVoiceConf($params['webVoiceConf'])
            ->setCreationTime($params['creationTime'])->addUserData('countrycode', $params['userdata_countrycode'])
            ->addUserData('email', $params['userdata_email'])->addUserData('commercial', $params['userdata_commercial']);
    }

    /**
     * @return array
     */
    protected function generateEndMeetingParams()
    {
        return ['meetingId' => $this->faker->uuid,
            'password'      => $this->faker->password, ];
    }

    /**
     * @param $params array
     *
     * @return EndMeetingParameters
     */
    protected function getEndMeetingMock($params)
    {
        return new EndMeetingParameters($params['meetingId'], $params['password']);
    }

    /**
     * @param $bbb BigBlueButton
     *
     * @return UpdateRecordingsResponse
     */
    protected function updateRecordings($bbb)
    {
        $updateRecordingsParams = $this->generateUpdateRecordingsParams();
        $updateRecordingsMock   = $this->getUpdateRecordingsParamsMock($updateRecordingsParams);

        return $bbb->updateRecordings($updateRecordingsMock);
    }

    /**
     * @return array
     */
    protected function generateUpdateRecordingsParams()
    {
        return [
            'recordingId'    => $this->faker->uuid,
            'meta_presenter' => $this->faker->name,
        ];
    }

    /**
     * @param $params array
     *
     * @return UpdateRecordingsParameters
     */
    protected function getUpdateRecordingsParamsMock($params)
    {
        $updateRecordingsParams = new UpdateRecordingsParameters($params['recordingId']);

        return $updateRecordingsParams->addMeta('presenter', $params['meta_presenter']);
    }

    // Load fixtures

    protected function loadXmlFile($path)
    {
        return simplexml_load_string(file_get_contents(($path)));
    }

    protected function minifyString($string)
    {
        return str_replace(["\r\n", "\r", "\n", "\t", ' '], '', $string);
    }
}
