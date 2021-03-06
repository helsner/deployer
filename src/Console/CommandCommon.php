<?php
/* (c) Anton Medvedev <anton@medv.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Deployer\Console;

use Deployer\Deployer;
use Deployer\Support\Reporter;

trait CommandCommon
{
    /**
     * Collecting anonymous stat helps Deployer team improve developer experience.
     * If you are not comfortable with this, you will always be able to disable this
     * by setting DO_NOT_TRACK environment variable to `1`.
     * @codeCoverageIgnore
     */
    protected function telemetry(array $data = [])
    {
        if (getenv('DO_NOT_TRACK') === '1') {
            return;
        }
        try {
            Reporter::report(array_merge([
                'command_name' => $this->getName(),
                'deployer_version' => DEPLOYER_VERSION,
                'deployer_phar' => Deployer::isPharArchive(),
                'php_version' => phpversion(),
                'extension_pcntl' => extension_loaded('pcntl'),
                'extension_curl' => extension_loaded('curl'),
                'os' => defined('PHP_OS_FAMILY') ? PHP_OS_FAMILY : (stristr(PHP_OS, 'DAR') ? 'OSX' : (stristr(PHP_OS, 'WIN') ? 'WIN' : (stristr(PHP_OS, 'LINUX') ? 'LINUX' : PHP_OS))),
            ], $data));
        } catch (\Throwable $e) {
            return;
        }
    }

}
