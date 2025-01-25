<?php

arch('it will not use debugging functions', function () {
    expect(['dd', 'dump', 'ray'])
        ->each->not->toBeUsed();
});

// arch('it uses the file cache driver')
//    ->expect(config('cache.default'))
//    ->toBe('file');
