#!/usr/local/bin/php81.cli
<?php
chdir(__DIR__);
passthru('/usr/local/bin/php81.cli artisan schedule:run');