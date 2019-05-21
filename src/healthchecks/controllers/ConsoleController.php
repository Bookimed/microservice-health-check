<?php
/**
 * @author Alexander Stepanenko <alex.stepanenko@gmail.com>
 * @package indigerd\healthchecks
 */

namespace indigerd\healthchecks\controllers;

use Yii;
use yii\console\Controller;

class ConsoleController extends Controller
{
    const EXIT_CODE_CONSUL_HEARTBEAT_FAIL = 2;

    public function actionIndex()
    {
        /** @var \indigerd\healthchecks\Module $module */
        $module = \Yii::$app->getModule(
            isset(\Yii::$app->params['healthChecksModuleName'])
                ? \Yii::$app->params['healthChecksModuleName']
                : 'healthchecks'
        );
        $result = $module->doHealthChecks();

        if ($module->getHealth()) {
            return self::EXIT_CODE_NORMAL;
        }
        return self::EXIT_CODE_CONSUL_HEARTBEAT_FAIL;
    }
}
