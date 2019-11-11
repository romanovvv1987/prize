<?php

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;

/**
 * Command to to send cash prizes to users
 */
class SendMoneyPrizeController extends Controller
{
    /**
     * Sending money that has not been sent to user accounts yet
     *
     * @return int Exit code
     */
    public function actionSend()
    {
        // TODO: Sending will be here

        return ExitCode::OK;
    }
}
