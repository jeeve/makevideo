<?php

echo 'makevideo';



$mov = new ffmpeg_movie('/video/video.avi');

echo sprintf('<p>Duration : %.1f, bit rate : %d, frame count : %d, video codec : %s, audio codec : %s, audio channel : %s</p>',
                $mov->getDuration(),
                $mov->getBitRate(),
                $mov->getFrameCount(),
                $mov->getVideoCodec(),
                $mov->getAudioCodec(),
                $mov->getAudioChannels());



?>