<?php

function logMessage($level, $message, $file = '../logs/info_log.txt')
{
    $currentDate = date('Y-m-d');
    $logFileName = '../logs/' . $currentDate . '_logger.log';
    $logFile = fopen($logFileName, 'a');
    $logMessage = sprintf(
        "[%s] [%s] --> %s\n",
        strtoupper($level),
        date('Y-m-d H:i:s'),
        $message
    );
    if ($logFile) {
        fwrite($logFile, $logMessage);
        fclose($logFile);
        echo "Log file created and entry added successfully.";
    } else {
        echo "Failed to open the log file.";
    }
}
