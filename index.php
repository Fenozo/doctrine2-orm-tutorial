<?php
require join(DIRECTORY_SEPARATOR,['config','bootstrap.php']);

$app = new \App\Application([
    BlogModule::class
]);