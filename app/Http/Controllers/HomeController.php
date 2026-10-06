<?php

namespace App\Http\Controllers;

use App\Models\TestResult;
use GuzzleHttp\TransferStats;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public array $system_admin = [
        'email' => 'beacrew_admin.vallaboratory@rooking.co.jp',
        'password' => 'password',
    ];

    public array $tenant_admin = [
        'email' => 'tenant_admin.vallaboratory@rooking.co.jp',
        'password' => 'password',
    ];

    public array $tenant_member = [
        'email' => 'user.vallaboratory@rooking.co.jp',
        'password' => 'password',
    ];

    public array $area = [
        'areas' => [
            'special_areas' => [
                [
                    'konvaId' => '31c7967c-c694-45f0-b4ac-78155ce3ce03',
                    'points' => [1218, 66, 1218, 880, 1300, 880, 1300, 66],
                    'property' => 'Special Area 1',
                ],
                [
                    'konvaId' => '80f4984c-ad1b-400e-bf3d-dc0fd2fb8e29',
                    'points' => [1310, 66, 1310, 880, 1376, 880, 1376, 66],
                    'property' => 'Special Area 2',
                ],
            ],
            'forbidden_areas' => [
                [
                    'konvaId' => '39dd3287-82c8-4be8-b5e2-45afaf1423f9',
                    'points' => [132, 64, 132, 412, 592, 412, 592, 64],
                ],
                [
                    'konvaId' => 'a0cf06df-6ba9-4d90-a5a7-4d6f8318f584',
                    'points' => [614, 64, 614, 412, 1188, 412, 1188, 64],
                ],
            ],
            'target_areas' => [
                [
                    'konvaId' => '088a5702-faa7-4eed-b29b-c29f44c2554c',
                    'points' => [38, 34, 38, 938, 1956, 938, 1956, 34],
                ],
            ],
        ],
    ];

    public array $grid = [
        'grid_data' => [
            ['(0,0)', 54, 53, 80],
            ['(1,0)', 114, 53, 80],
            ['(2,0)', 174, 53, 80],
            ['(3,0)', 234, 53, 80],
            ['(4,0)', 294, 53, 80],
            ['(5,0)', 354, 53, 80],
            ['(6,0)', 414, 53, 80],
            ['(7,0)', 474, 53, 80],
            ['(8,0)', 534, 53, 80],
            ['(9,0)', 594, 53, 80],
            ['(10,0)', 654, 53, 80],
            ['(11,0)', 714, 53, 80],
            ['(12,0)', 774, 53, 80],
            ['(13,0)', 834, 53, 80],
            ['(14,0)', 894, 53, 80],
            ['(15,0)', 954, 53, 80],
            ['(16,0)', 1014, 53, 80],
            ['(17,0)', 1074, 53, 80],
            ['(18,0)', 1134, 53, 80],
            ['(19,0)', 1194, 53, 80],
            ['(20,0)', 1254, 53, 80],
            ['(21,0)', 1314, 53, 80],
            ['(22,0)', 1374, 53, 80],
            ['(23,0)', 1434, 53, 80],
            ['(24,0)', 1494, 53, 80],
            ['(25,0)', 1554, 53, 80],
            ['(26,0)', 1614, 53, 80],
            ['(27,0)', 1674, 53, 80],
            ['(28,0)', 1734, 53, 80],
            ['(29,0)', 1794, 53, 80],
            ['(30,0)', 1854, 53, 80],
            ['(0,1)', 54, 113, 80],
            ['(1,1)', 114, 113, 80],
            ['(2,1)', 174, 113, 80],
            ['(3,1)', 234, 113, 80],
            ['(4,1)', 294, 113, 80],
            ['(5,1)', 354, 113, 80],
            ['(6,1)', 414, 113, 80],
            ['(7,1)', 474, 113, 80],
            ['(8,1)', 534, 113, 80],
            ['(9,1)', 594, 113, 80],
            ['(10,1)', 654, 113, 80],
            ['(11,1)', 714, 113, 80],
            ['(12,1)', 774, 113, 80],
            ['(13,1)', 834, 113, 80],
            ['(14,1)', 894, 113, 80],
            ['(15,1)', 954, 113, 80],
            ['(16,1)', 1014, 113, 80],
            ['(17,1)', 1074, 113, 80],
            ['(18,1)', 1134, 113, 80],
            ['(19,1)', 1194, 113, 80],
            ['(20,1)', 1254, 113, 80],
            ['(21,1)', 1314, 113, 80],
            ['(22,1)', 1374, 113, 80],
            ['(23,1)', 1434, 113, 80],
            ['(24,1)', 1494, 113, 80],
            ['(25,1)', 1554, 113, 80],
            ['(26,1)', 1614, 113, 80],
            ['(27,1)', 1674, 113, 80],
            ['(28,1)', 1734, 113, 80],
            ['(29,1)', 1794, 113, 80],
            ['(30,1)', 1854, 113, 80],
            ['(0,2)', 54, 173, 80],
            ['(1,2)', 114, 173, 80],
            ['(2,2)', 174, 173, 80],
            ['(3,2)', 234, 173, 80],
            ['(4,2)', 294, 173, 80],
            ['(5,2)', 354, 173, 80],
            ['(6,2)', 414, 173, 80],
            ['(7,2)', 474, 173, 80],
            ['(8,2)', 534, 173, 80],
            ['(9,2)', 594, 173, 80],
            ['(10,2)', 654, 173, 80],
            ['(11,2)', 714, 173, 80],
            ['(12,2)', 774, 173, 80],
            ['(13,2)', 834, 173, 80],
            ['(14,2)', 894, 173, 80],
            ['(15,2)', 954, 173, 80],
            ['(16,2)', 1014, 173, 80],
            ['(17,2)', 1074, 173, 80],
            ['(18,2)', 1134, 173, 80],
            ['(19,2)', 1194, 173, 80],
            ['(20,2)', 1254, 173, 80],
            ['(21,2)', 1314, 173, 80],
            ['(22,2)', 1374, 173, 80],
            ['(23,2)', 1434, 173, 80],
            ['(24,2)', 1494, 173, 80],
            ['(25,2)', 1554, 173, 80],
            ['(26,2)', 1614, 173, 80],
            ['(27,2)', 1674, 173, 80],
            ['(28,2)', 1734, 173, 80],
            ['(29,2)', 1794, 173, 80],
            ['(30,2)', 1854, 173, 80],
            ['(0,3)', 54, 233, 80],
            ['(1,3)', 114, 233, 80],
            ['(2,3)', 174, 233, 80],
            ['(3,3)', 234, 233, 80],
            ['(4,3)', 294, 233, 80],
            ['(5,3)', 354, 233, 80],
            ['(6,3)', 414, 233, 80],
            ['(7,3)', 474, 233, 80],
            ['(8,3)', 534, 233, 80],
            ['(9,3)', 594, 233, 80],
            ['(10,3)', 654, 233, 80],
            ['(11,3)', 714, 233, 80],
            ['(12,3)', 774, 233, 80],
            ['(13,3)', 834, 233, 80],
            ['(14,3)', 894, 233, 80],
            ['(15,3)', 954, 233, 80],
            ['(16,3)', 1014, 233, 80],
            ['(17,3)', 1074, 233, 80],
            ['(18,3)', 1134, 233, 80],
            ['(19,3)', 1194, 233, 80],
            ['(20,3)', 1254, 233, 80],
            ['(21,3)', 1314, 233, 80],
            ['(22,3)', 1374, 233, 80],
            ['(23,3)', 1434, 233, 80],
            ['(24,3)', 1494, 233, 80],
            ['(25,3)', 1554, 233, 80],
            ['(26,3)', 1614, 233, 80],
            ['(27,3)', 1674, 233, 80],
            ['(28,3)', 1734, 233, 80],
            ['(29,3)', 1794, 233, 80],
            ['(30,3)', 1854, 233, 80],
            ['(0,4)', 54, 293, 80],
            ['(1,4)', 114, 293, 80],
            ['(2,4)', 174, 293, 80],
            ['(3,4)', 234, 293, 80],
            ['(4,4)', 294, 293, 80],
            ['(5,4)', 354, 293, 80],
            ['(6,4)', 414, 293, 80],
            ['(7,4)', 474, 293, 80],
            ['(8,4)', 534, 293, 80],
            ['(9,4)', 594, 293, 80],
            ['(10,4)', 654, 293, 80],
            ['(11,4)', 714, 293, 80],
            ['(12,4)', 774, 293, 80],
            ['(13,4)', 834, 293, 80],
            ['(14,4)', 894, 293, 80],
            ['(15,4)', 954, 293, 80],
            ['(16,4)', 1014, 293, 80],
            ['(17,4)', 1074, 293, 80],
            ['(18,4)', 1134, 293, 80],
            ['(19,4)', 1194, 293, 80],
            ['(20,4)', 1254, 293, 80],
            ['(21,4)', 1314, 293, 80],
            ['(22,4)', 1374, 293, 80],
            ['(23,4)', 1434, 293, 80],
            ['(24,4)', 1494, 293, 80],
            ['(25,4)', 1554, 293, 80],
            ['(26,4)', 1614, 293, 80],
            ['(27,4)', 1674, 293, 80],
            ['(28,4)', 1734, 293, 80],
            ['(29,4)', 1794, 293, 80],
            ['(30,4)', 1854, 293, 80],
            ['(0,5)', 54, 353, 80],
            ['(1,5)', 114, 353, 80],
            ['(2,5)', 174, 353, 80],
            ['(3,5)', 234, 353, 80],
            ['(4,5)', 294, 353, 80],
            ['(5,5)', 354, 353, 80],
            ['(6,5)', 414, 353, 80],
            ['(7,5)', 474, 353, 80],
            ['(8,5)', 534, 353, 80],
            ['(9,5)', 594, 353, 80],
            ['(10,5)', 654, 353, 80],
            ['(11,5)', 714, 353, 80],
            ['(12,5)', 774, 353, 80],
            ['(13,5)', 834, 353, 80],
            ['(14,5)', 894, 353, 80],
            ['(15,5)', 954, 353, 80],
            ['(16,5)', 1014, 353, 80],
            ['(17,5)', 1074, 353, 80],
            ['(18,5)', 1134, 353, 80],
            ['(19,5)', 1194, 353, 80],
            ['(20,5)', 1254, 353, 80],
            ['(21,5)', 1314, 353, 80],
            ['(22,5)', 1374, 353, 80],
            ['(23,5)', 1434, 353, 80],
            ['(24,5)', 1494, 353, 80],
            ['(25,5)', 1554, 353, 80],
            ['(26,5)', 1614, 353, 80],
            ['(27,5)', 1674, 353, 80],
            ['(28,5)', 1734, 353, 80],
            ['(29,5)', 1794, 353, 80],
            ['(30,5)', 1854, 353, 80],
            ['(0,6)', 54, 413, 80],
            ['(1,6)', 114, 413, 80],
            ['(2,6)', 174, 413, 80],
            ['(3,6)', 234, 413, 80],
            ['(4,6)', 294, 413, 80],
            ['(5,6)', 354, 413, 80],
            ['(6,6)', 414, 413, 80],
            ['(7,6)', 474, 413, 80],
            ['(8,6)', 534, 413, 80],
            ['(9,6)', 594, 413, 80],
            ['(10,6)', 654, 413, 80],
            ['(11,6)', 714, 413, 80],
            ['(12,6)', 774, 413, 80],
            ['(13,6)', 834, 413, 80],
            ['(14,6)', 894, 413, 80],
            ['(15,6)', 954, 413, 80],
            ['(16,6)', 1014, 413, 80],
            ['(17,6)', 1074, 413, 80],
            ['(18,6)', 1134, 413, 80],
            ['(19,6)', 1194, 413, 80],
            ['(20,6)', 1254, 413, 80],
            ['(21,6)', 1314, 413, 80],
            ['(22,6)', 1374, 413, 80],
            ['(23,6)', 1434, 413, 80],
            ['(24,6)', 1494, 413, 80],
            ['(25,6)', 1554, 413, 80],
            ['(26,6)', 1614, 413, 80],
            ['(27,6)', 1674, 413, 80],
            ['(28,6)', 1734, 413, 80],
            ['(29,6)', 1794, 413, 80],
            ['(30,6)', 1854, 413, 80],
            ['(0,7)', 54, 473, 80],
            ['(1,7)', 114, 473, 80],
            ['(2,7)', 174, 473, 80],
            ['(3,7)', 234, 473, 80],
            ['(4,7)', 294, 473, 80],
            ['(5,7)', 354, 473, 80],
            ['(6,7)', 414, 473, 80],
            ['(7,7)', 474, 473, 80],
            ['(8,7)', 534, 473, 80],
            ['(9,7)', 594, 473, 80],
            ['(10,7)', 654, 473, 80],
            ['(11,7)', 714, 473, 80],
            ['(12,7)', 774, 473, 80],
            ['(13,7)', 834, 473, 80],
            ['(14,7)', 894, 473, 80],
            ['(15,7)', 954, 473, 80],
            ['(16,7)', 1014, 473, 80],
            ['(17,7)', 1074, 473, 80],
            ['(18,7)', 1134, 473, 80],
            ['(19,7)', 1194, 473, 80],
            ['(20,7)', 1254, 473, 80],
            ['(21,7)', 1314, 473, 80],
            ['(22,7)', 1374, 473, 80],
            ['(23,7)', 1434, 473, 80],
            ['(24,7)', 1494, 473, 80],
            ['(25,7)', 1554, 473, 80],
            ['(26,7)', 1614, 473, 80],
            ['(27,7)', 1674, 473, 80],
            ['(28,7)', 1734, 473, 80],
            ['(29,7)', 1794, 473, 80],
            ['(30,7)', 1854, 473, 80],
            ['(0,8)', 54, 533, 80],
            ['(1,8)', 114, 533, 80],
            ['(2,8)', 174, 533, 80],
            ['(3,8)', 234, 533, 80],
            ['(4,8)', 294, 533, 80],
            ['(5,8)', 354, 533, 80],
            ['(6,8)', 414, 533, 80],
            ['(7,8)', 474, 533, 80],
            ['(8,8)', 534, 533, 80],
            ['(9,8)', 594, 533, 80],
            ['(10,8)', 654, 533, 80],
            ['(11,8)', 714, 533, 80],
            ['(12,8)', 774, 533, 80],
            ['(13,8)', 834, 533, 80],
            ['(14,8)', 894, 533, 80],
            ['(15,8)', 954, 533, 80],
            ['(16,8)', 1014, 533, 80],
            ['(17,8)', 1074, 533, 80],
            ['(18,8)', 1134, 533, 80],
            ['(19,8)', 1194, 533, 80],
            ['(20,8)', 1254, 533, 80],
            ['(21,8)', 1314, 533, 80],
            ['(22,8)', 1374, 533, 80],
            ['(23,8)', 1434, 533, 80],
            ['(24,8)', 1494, 533, 80],
            ['(25,8)', 1554, 533, 80],
            ['(26,8)', 1614, 533, 80],
            ['(27,8)', 1674, 533, 80],
            ['(28,8)', 1734, 533, 80],
            ['(29,8)', 1794, 533, 80],
            ['(30,8)', 1854, 533, 80],
            ['(0,9)', 54, 593, 80],
            ['(1,9)', 114, 593, 80],
            ['(2,9)', 174, 593, 80],
            ['(3,9)', 234, 593, 80],
            ['(4,9)', 294, 593, 80],
            ['(5,9)', 354, 593, 80],
            ['(6,9)', 414, 593, 80],
            ['(7,9)', 474, 593, 80],
            ['(8,9)', 534, 593, 80],
            ['(9,9)', 594, 593, 80],
            ['(10,9)', 654, 593, 80],
            ['(11,9)', 714, 593, 80],
            ['(12,9)', 774, 593, 80],
            ['(13,9)', 834, 593, 80],
            ['(14,9)', 894, 593, 80],
            ['(15,9)', 954, 593, 80],
            ['(16,9)', 1014, 593, 80],
            ['(17,9)', 1074, 593, 80],
            ['(18,9)', 1134, 593, 80],
            ['(19,9)', 1194, 593, 80],
            ['(20,9)', 1254, 593, 80],
            ['(21,9)', 1314, 593, 80],
            ['(22,9)', 1374, 593, 80],
            ['(23,9)', 1434, 593, 80],
            ['(24,9)', 1494, 593, 80],
            ['(25,9)', 1554, 593, 80],
            ['(26,9)', 1614, 593, 80],
            ['(27,9)', 1674, 593, 80],
            ['(28,9)', 1734, 593, 80],
            ['(29,9)', 1794, 593, 80],
            ['(30,9)', 1854, 593, 80],
            ['(0,10)', 54, 653, 80],
            ['(1,10)', 114, 653, 80],
            ['(2,10)', 174, 653, 80],
            ['(3,10)', 234, 653, 80],
            ['(4,10)', 294, 653, 80],
            ['(5,10)', 354, 653, 80],
            ['(6,10)', 414, 653, 80],
            ['(7,10)', 474, 653, 80],
            ['(8,10)', 534, 653, 80],
            ['(9,10)', 594, 653, 80],
            ['(10,10)', 654, 653, 80],
            ['(11,10)', 714, 653, 80],
            ['(12,10)', 774, 653, 80],
            ['(13,10)', 834, 653, 80],
            ['(14,10)', 894, 653, 80],
            ['(15,10)', 954, 653, 80],
            ['(16,10)', 1014, 653, 80],
            ['(17,10)', 1074, 653, 80],
            ['(18,10)', 1134, 653, 80],
            ['(19,10)', 1194, 653, 80],
            ['(20,10)', 1254, 653, 80],
            ['(21,10)', 1314, 653, 80],
            ['(22,10)', 1374, 653, 80],
            ['(23,10)', 1434, 653, 80],
            ['(24,10)', 1494, 653, 80],
            ['(25,10)', 1554, 653, 80],
            ['(26,10)', 1614, 653, 80],
            ['(27,10)', 1674, 653, 80],
            ['(28,10)', 1734, 653, 80],
            ['(29,10)', 1794, 653, 80],
            ['(30,10)', 1854, 653, 80],
            ['(0,11)', 54, 713, 80],
            ['(1,11)', 114, 713, 80],
            ['(2,11)', 174, 713, 80],
            ['(3,11)', 234, 713, 80],
            ['(4,11)', 294, 713, 80],
            ['(5,11)', 354, 713, 80],
            ['(6,11)', 414, 713, 80],
            ['(7,11)', 474, 713, 80],
            ['(8,11)', 534, 713, 80],
            ['(9,11)', 594, 713, 80],
            ['(10,11)', 654, 713, 80],
            ['(11,11)', 714, 713, 80],
            ['(12,11)', 774, 713, 80],
            ['(13,11)', 834, 713, 80],
            ['(14,11)', 894, 713, 80],
            ['(15,11)', 954, 713, 80],
            ['(16,11)', 1014, 713, 80],
            ['(17,11)', 1074, 713, 80],
            ['(18,11)', 1134, 713, 80],
            ['(19,11)', 1194, 713, 80],
            ['(20,11)', 1254, 713, 80],
            ['(21,11)', 1314, 713, 80],
            ['(22,11)', 1374, 713, 80],
            ['(23,11)', 1434, 713, 80],
            ['(24,11)', 1494, 713, 80],
            ['(25,11)', 1554, 713, 80],
            ['(26,11)', 1614, 713, 80],
            ['(27,11)', 1674, 713, 80],
            ['(28,11)', 1734, 713, 80],
            ['(29,11)', 1794, 713, 80],
            ['(30,11)', 1854, 713, 80],
            ['(0,12)', 54, 773, 80],
            ['(1,12)', 114, 773, 80],
            ['(2,12)', 174, 773, 80],
            ['(3,12)', 234, 773, 80],
            ['(4,12)', 294, 773, 80],
            ['(5,12)', 354, 773, 80],
            ['(6,12)', 414, 773, 80],
            ['(7,12)', 474, 773, 80],
            ['(8,12)', 534, 773, 80],
            ['(9,12)', 594, 773, 80],
            ['(10,12)', 654, 773, 80],
            ['(11,12)', 714, 773, 80],
            ['(12,12)', 774, 773, 80],
            ['(13,12)', 834, 773, 80],
            ['(14,12)', 894, 773, 80],
            ['(15,12)', 954, 773, 80],
            ['(16,12)', 1014, 773, 80],
            ['(17,12)', 1074, 773, 80],
            ['(18,12)', 1134, 773, 80],
            ['(19,12)', 1194, 773, 80],
            ['(20,12)', 1254, 773, 80],
            ['(21,12)', 1314, 773, 80],
            ['(22,12)', 1374, 773, 80],
            ['(23,12)', 1434, 773, 80],
            ['(24,12)', 1494, 773, 80],
            ['(25,12)', 1554, 773, 80],
            ['(26,12)', 1614, 773, 80],
            ['(27,12)', 1674, 773, 80],
            ['(28,12)', 1734, 773, 80],
            ['(29,12)', 1794, 773, 80],
            ['(30,12)', 1854, 773, 80],
            ['(0,13)', 54, 833, 80],
            ['(1,13)', 114, 833, 80],
            ['(2,13)', 174, 833, 80],
            ['(3,13)', 234, 833, 80],
            ['(4,13)', 294, 833, 80],
            ['(5,13)', 354, 833, 80],
            ['(6,13)', 414, 833, 80],
            ['(7,13)', 474, 833, 80],
            ['(8,13)', 534, 833, 80],
            ['(9,13)', 594, 833, 80],
            ['(10,13)', 654, 833, 80],
            ['(11,13)', 714, 833, 80],
            ['(12,13)', 774, 833, 80],
            ['(13,13)', 834, 833, 80],
            ['(14,13)', 894, 833, 80],
            ['(15,13)', 954, 833, 80],
            ['(16,13)', 1014, 833, 80],
            ['(17,13)', 1074, 833, 80],
            ['(18,13)', 1134, 833, 80],
            ['(19,13)', 1194, 833, 80],
            ['(20,13)', 1254, 833, 80],
            ['(21,13)', 1314, 833, 80],
            ['(22,13)', 1374, 833, 80],
            ['(23,13)', 1434, 833, 80],
            ['(24,13)', 1494, 833, 80],
            ['(25,13)', 1554, 833, 80],
            ['(26,13)', 1614, 833, 80],
            ['(27,13)', 1674, 833, 80],
            ['(28,13)', 1734, 833, 80],
            ['(29,13)', 1794, 833, 80],
            ['(30,13)', 1854, 833, 80],
            ['(0,14)', 54, 893, 80],
            ['(1,14)', 114, 893, 80],
            ['(2,14)', 174, 893, 80],
            ['(3,14)', 234, 893, 80],
            ['(4,14)', 294, 893, 80],
            ['(5,14)', 354, 893, 80],
            ['(6,14)', 414, 893, 80],
            ['(7,14)', 474, 893, 80],
            ['(8,14)', 534, 893, 80],
            ['(9,14)', 594, 893, 80],
            ['(10,14)', 654, 893, 80],
            ['(11,14)', 714, 893, 80],
            ['(12,14)', 774, 893, 80],
            ['(13,14)', 834, 893, 80],
            ['(14,14)', 894, 893, 80],
            ['(15,14)', 954, 893, 80],
            ['(16,14)', 1014, 893, 80],
            ['(17,14)', 1074, 893, 80],
            ['(18,14)', 1134, 893, 80],
            ['(19,14)', 1194, 893, 80],
            ['(20,14)', 1254, 893, 80],
            ['(21,14)', 1314, 893, 80],
            ['(22,14)', 1374, 893, 80],
            ['(23,14)', 1434, 893, 80],
            ['(24,14)', 1494, 893, 80],
            ['(25,14)', 1554, 893, 80],
            ['(26,14)', 1614, 893, 80],
            ['(27,14)', 1674, 893, 80],
            ['(28,14)', 1734, 893, 80],
            ['(29,14)', 1794, 893, 80],
            ['(30,14)', 1854, 893, 80],
        ],
        'img_width' => 2000,
        'img_height' => 1036,
    ];

    public array $route = [
        'routeDateFrom' => '2026-01-03 00:00',
        'routeDateTo' => '2026-01-03 23:59',
        'algorithmId' => 1,
        'memo' => '',
        'isBookmark' => false,
    ];

    public array $_tenant_member = [
        'last_name' => '山田',
        'first_name' => '太郎',
        'last_name_kana' => 'ヤマダ',
        'first_name_kana' => 'タロウ',
        'auto_add_cluster' => true,
        'memo' => null,
    ];

    public string $laravel_api = 'https://app-stage.loco-insights.jp';

    public string $fast_api = 'https://api-ai-stage.loco-insights.jp';

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): array
    {
        $api_results = collect();
        $access_token = null;
        $api_results->push($this->login(Arr::only($this->system_admin, ['email', 'password']), $access_token));
        $api_results->push($this->refreshJwt($access_token));
        $result = $this->forgotPassword($access_token, Arr::only($this->system_admin, ['email']));
        if (is_array($result)) {
            $api_results->push($result);
        }
        $result = $this->resetPassword($access_token, [
            'email' => data_get($this->system_admin, 'email'),
            'password' => data_get($this->system_admin, 'password'),
            'token' => null,
        ]);
        if (is_array($result)) {
            $api_results->push($result);
        }
        $result = $this->setPassword($access_token, [
            'email' => data_get($this->system_admin, 'email'),
            'password' => data_get($this->system_admin, 'password'),
            'token' => null,
        ]);
        if (is_array($result)) {
            $api_results->push($result);
        }
        $current_user = null;
        $api_results->push($this->getCurrentUser($access_token, $current_user));
        $current_user_id = data_get($current_user, 'id');
        if (is_int($current_user_id)) {
            $api_results->push($this->updateSystemAdmin(
                $access_token,
                $current_user_id,
                [
                    'last_name' => '山田',
                    'first_name' => '太郎',
                    'last_name_kana' => 'ヤマダ',
                    'first_name_kana' => 'タロウ',
                    'email' => 'beacrew_admin.vallaboratory@rooking.co.jp',
                    'company_name' => 'ROOKING, Inc.',
                    'memo' => null,
                ]
            ));
        }
        $application_options = null;
        $api_results->push($this->getApplicationOptions($access_token, $application_options));
        $application_option_ids = data_get($application_options, '*.value');
        if (is_array($application_option_ids)) {
            array_shift($application_option_ids);
            $api_results->push($this->createTenantAdmin(
                $access_token,
                [
                    'last_name' => '山田',
                    'first_name' => '太郎',
                    'last_name_kana' => 'ヤマダ',
                    'first_name_kana' => 'タロウ',
                    'email' => sprintf('tenant_admin.vallaboratory.%s@rooking.co.jp', Str::lower(Str::random(10))),
                    'company_name' => 'ROOKING, Inc.',
                    'memo' => null,
                    'applications' => $application_option_ids,
                ]
            ));
            $this->createTenantAdmin(
                $access_token,
                [
                    'last_name' => '山田',
                    'first_name' => '太郎',
                    'last_name_kana' => 'ヤマダ',
                    'first_name_kana' => 'タロウ',
                    'email' => sprintf('tenant_admin.vallaboratory.%s@rooking.co.jp', Str::lower(Str::random(10))),
                    'company_name' => 'ROOKING, Inc.',
                    'memo' => null,
                    'applications' => $application_option_ids,
                ]
            );
        }
        $users = null;
        $api_results->push($this->getUsers($access_token, ['user_type' => 2], $users));
        if (is_array($users) && count($users) > 0) {
            $user_id = data_get($users, '0.id');
            $api_results->push($this->getUser($access_token, $user_id));
            $api_results->push($this->updateTenantAdmin(
                $access_token,
                $user_id,
                [
                    'last_name' => '山田',
                    'first_name' => '太郎',
                    'last_name_kana' => 'ヤマダ',
                    'first_name_kana' => 'タロウ',
                    'email' => sprintf('tenant_admin.vallaboratory.%s@rooking.co.jp', Str::lower(Str::random(10))),
                    'company_name' => 'ROOKING, Inc.',
                    'memo' => null,
                    'applications' => $application_option_ids,
                ]));
            $api_results->push($this->switchUser($access_token, $user_id));
        }
        // $api_results->push($this->logout($access_token));

        $access_token = null;
        $this->login(Arr::only($this->tenant_admin, ['email', 'password']), $access_token);
        $application_clusters = null;
        $api_results->push($this->getApplicationClusters($access_token, [], $application_clusters));
        if (is_array($application_clusters) && count($application_clusters) > 0) {
            $application_cluster_id = data_get($application_clusters, '0.id');
            $application_id = data_get($application_clusters, '0.app_id');
            $cluster_id = data_get($application_clusters, '0.cluster_id');
            $api_results->push($this->updateApplicationCluster(
                $access_token,
                $application_cluster_id,
                [
                    'floor_number' => 1,
                    'electrical_equipment' => 'あり',
                    'location' => '御堂筋口',
                    'purpose' => '改札',
                ]
            ));
            $api_results->push($this->getRealtimeDevice($access_token, $application_cluster_id));
            $api_results->push($this->getRealtimeData($access_token, $application_cluster_id, []));
            $this->area['app_cluster_id'] = $application_cluster_id;
            $area_name1 = sprintf('Area %s', Str::lower(Str::random(10)));
            $area_name2 = sprintf('Area %s', Str::lower(Str::random(10)));
            $this->area['area_name'] = $area_name1;
            $api_results->push($this->createArea($access_token, $this->area));
            $this->area['area_name'] = $area_name2;
            $this->createArea($access_token, $this->area);
            $areas = null;
            $api_results->push($this->getAreas($access_token, $application_cluster_id, [], $areas));
            $api_results->push($this->getAreasV2($access_token, $application_id, $cluster_id, []));
            $areas = null;
            $this->getAreas($access_token, $application_cluster_id, ['area_name' => $area_name1], $areas);
            if (is_array($areas) && count($areas) > 0) {
                $area_id = data_get($areas, '0.id');

                $api_results->push($this->getArea($access_token, $area_id));
                $api_results->push($this->deleteArea($access_token, $area_id));
            }
            $this->grid['app_cluster_id'] = $application_cluster_id;
            $grid_name1 = sprintf('Grid %s', Str::lower(Str::random(10)));
            $grid_name2 = sprintf('Grid %s', Str::lower(Str::random(10)));
            $this->grid['grid_name'] = $grid_name1;
            $api_results->push($this->createGrid($access_token, $this->grid));
            $this->grid['grid_name'] = $grid_name2;
            $this->createGrid($access_token, $this->grid);
            $grids = null;
            $api_results->push($this->getGrids($access_token, $application_cluster_id, [], $grids));
            $api_results->push($this->getGridsV2($access_token, $application_id, $cluster_id, []));
            $grids = null;
            $this->getGrids($access_token, $application_cluster_id, ['grid_name' => $grid_name1], $grids);
            if (is_array($grids) && count($grids) > 0) {
                $grid_id = data_get($grids, '0.id');

                $api_results->push($this->getGrid($access_token, $grid_id));
                $api_results->push($this->deleteGrid($access_token, $grid_id));
            }
            $walls = null;
            $api_results->push($this->getWalls($access_token, $application_cluster_id, [], $walls));
            $api_results->push($this->getWallsV2($access_token, $application_id, $cluster_id, []));
            if (is_array($walls) && count($walls) > 0) {
                $wall_id = data_get($walls, '0.id');

                $api_results->push($this->getWall($access_token, $wall_id));
            }
            $api_results->push($this->getClusterJoints($access_token, $application_cluster_id));
            $api_results->push($this->getClusterJointsV2($access_token, $application_id, $cluster_id));
            $cluster_joints = [
                'cluster_joints' => [
                    [
                        'x' => 504.96,
                        'y' => 84.48,
                        'joint_point_type' => 'point',
                        'title' => '階段',
                    ],
                ],
            ];
            $api_results->push($this->editClusterJoints($access_token, $application_cluster_id, $cluster_joints));
            $api_results->push($this->editClusterJointsV2($access_token, $application_id, $cluster_id, $cluster_joints));
            $areas = null;
            $this->getAreas($access_token, $application_cluster_id, ['area_name' => $area_name2], $areas);
            $grids = null;
            $this->getGrids($access_token, $application_cluster_id, ['grid_name' => $grid_name2], $grids);
            if (
                (is_array($areas) && count($areas) > 0) &&
                (is_array($grids) && count($grids) > 0) &&
                (is_array($walls) && count($walls) > 0)
            ) {
                $area_id = data_get($areas, '0.id');
                $grid_id = data_get($grids, '0.id');
                $wall_id = data_get($walls, '0.id');
                $this->route['applicationClusterId'] = $application_cluster_id;
                $this->route['areaId'] = $area_id;
                $this->route['gridId'] = $grid_id;
                $this->route['wallId'] = $wall_id;
                $route_name_1 = sprintf('Route %s', Str::lower(Str::random(10)));
                $route_name_2 = sprintf('Route %s', Str::lower(Str::random(10)));
                $this->route['title'] = $route_name_1;
                $api_results->push($this->createRoute($access_token, $this->route));
                $this->route['title'] = $route_name_2;
                $this->createRoute($access_token, $this->route);
                $routes = null;
                $api_results->push($this->getRoutes($access_token, [], $routes));
                $routes = null;
                $this->getRoutes($access_token, ['route_name' => $route_name_1], $routes);
                if (is_array($routes) && count($routes) > 0) {
                    $route_id = data_get($routes, '0.id');
                    $api_results->push($this->updateRoute($access_token, $route_id, [
                        'area_id' => $area_id,
                        'grid_id' => $grid_id,
                        'wall_id' => $wall_id,
                        'start_time' => '2026-01-03 00:00',
                        'end_time' => '2026-01-03 23:59',
                        'algorithm_id' => 1,
                        'name' => sprintf('Route %s', Str::lower(Str::random(10))),
                        'descriptions' => '',
                    ]));
                    $api_results->push($this->getRealtimeAlert($access_token, $route_id));
                    $api_results->push($this->getRouteDataDraw($access_token, $route_id));
                    $api_results->push($this->getRouteDataDevice($access_token, $route_id));
                    $api_results->push($this->getRouteData($access_token, $route_id, []));
                    $api_results->push($this->getAnalysisDataDevice($access_token, $route_id));
                    $api_results->push($this->getRoute($access_token, $route_id));
                    $api_results->push($this->toggleRouteBookmark($access_token, $route_id));
                    $api_results->push($this->createAnalysisHistory($access_token, $route_id, [
                        'analysisId' => 'ANL-C1',
                        'categoryKey' => 'heat',
                        'analysisName' => sprintf('Analysis History %s', Str::lower(Str::random(10))),
                        'status' => 'pending',
                    ]));
                    $analysis_histories = null;
                    $api_results->push($this->getAnalysisHistories($access_token, $route_id, $analysis_histories));
                    if (is_array($analysis_histories) && count($analysis_histories) > 0) {
                        $analysis_history_id = data_get($analysis_histories, '0.historyId');
                        $api_results->push($this->getAnalysisHistory($access_token, $route_id, $analysis_history_id));
                        $api_results->push($this->updateAnalysisHistoryPin($access_token, $route_id, $analysis_history_id, [
                            'pinned' => true,
                        ]));
                    }
                }
                $routes = null;
                $this->getRoutes($access_token, ['route_name' => $route_name_2], $routes);
                if (is_array($routes) && count($routes) > 0) {
                    $route_id = data_get($routes, '0.id');
                    $api_results->push($this->deleteRoute($access_token, $route_id));
                }
            }
        }
        $api_results->push($this->getPositionLogs($access_token, []));
        $api_results->push($this->getPositionLogBeacons($access_token));
        $api_results->push($this->getPositionLogDevices($access_token));
        $application_cluster_options = null;
        $api_results->push($this->getApplicationClusterOptions($access_token, $application_cluster_options));
        $application_cluster_option_ids = data_get($application_cluster_options, '*.value');
        if (is_array($application_cluster_option_ids)) {
            array_shift($application_cluster_option_ids);
            $this->_tenant_member['app_clusters'] = $application_cluster_option_ids;
            $email_tenant_member = sprintf('member.%s@rooking.co.jp', Str::lower(Str::random(10)));
            $this->_tenant_member['email'] = $email_tenant_member;
            $api_results->push($this->createTenantMember($access_token, $this->_tenant_member));
            $this->_tenant_member['email'] = sprintf('member.%s@rooking.co.jp', Str::lower(Str::random(10)));
            $this->createTenantMember($access_token, $this->_tenant_member);
            $this->_tenant_member['email'] = sprintf('staff.%s@rooking.co.jp', Str::lower(Str::random(10)));
            $api_results->push($this->createTenantStaff($access_token, $this->_tenant_member));
            $this->createTenantStaff($access_token, $this->_tenant_member);
        }
        $users = null;
        $this->getUsers($access_token, ['user_type', 3], $users);
        if (is_array($users) && count($users) > 0) {
            $user_id = data_get($users, '0.id');
            $email_tenant_member = sprintf('member.%s@rooking.co.jp', Str::lower(Str::random(10)));
            $this->_tenant_member['email'] = $email_tenant_member;
            $api_results->push($this->updateTenantMember($access_token, $user_id, $this->_tenant_member));
        }
        if (isset($email_tenant_member)) {
            $users = null;
            $this->getUsers($access_token, ['user_type', 3, 'filter' => $email_tenant_member], $users);
            if (is_array($users) && count($users) > 0) {
                $user_id = data_get($users, '0.id');
                $api_results->push($this->deleteUser($access_token, $user_id));
            }
        }
        $users = null;
        $this->getUsers($access_token, ['user_type', 4], $users);
        if (is_array($users) && count($users) > 0) {
            $user_id = data_get($users, '0.id');
            $this->_tenant_member['email'] = sprintf('staff.%s@rooking.co.jp', Str::lower(Str::random(10)));
            $api_results->push($this->updateTenantStaff($access_token, $user_id, $this->_tenant_member));
        }

        $access_token = null;
        $this->login(Arr::only($this->tenant_member, ['email', 'password']), $access_token);
        // $api_results->push($this->logoutAll($access_token));

        TestResult::insert(
            $api_results
                ->map(function (array $api_result) use ($request): array {
                    $api_result['concurrent_users'] = $request->integer('concurrent_users', 1);

                    return $api_result;
                })
                ->toArray()
        );

        return [
            'results' => $api_results,
            'total' => $api_results->count(),
        ];
    }

    protected function login(array $data, ?string &$access_token): array
    {
        $api_url = 'login';
        $response_file_path = storage_path('app/private/responses/post_login.json');
        $api = 'POST login';

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withHeader('Accept', 'application/json')
                ->post($api_url, $data);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            $access_token = $response->json('access_token');

            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function refreshJwt(?string &$access_token): array
    {
        $api_url = 'api/refresh-jwt';
        $response_file_path = storage_path('app/private/responses/post_api_refresh_jwt.json');
        $api = 'POST api/refresh-jwt';

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->post($api_url);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            $access_token = $response->json('access_token');

            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function forgotPassword(?string $access_token, array $data): ?array
    {
        $api_url = 'forgot-password';
        $response_file_path = storage_path('app/private/responses/post_forgot_password.json');
        $api = 'POST forgot-password';

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->post($api_url, $data);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->status() === 422) {
            return null;
        }

        if ($response->successful()) {
            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function resetPassword(?string $access_token, array $data): ?array
    {
        $api_url = 'reset-password';
        $response_file_path = storage_path('app/private/responses/post_reset_password.json');
        $api = 'POST reset-password';

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->post($api_url, $data);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->status() === 422) {
            return null;
        }

        if ($response->successful()) {
            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function setPassword(?string $access_token, array $data): ?array
    {
        $api_url = 'api/set-password';
        $response_file_path = storage_path('app/private/responses/post_api_set_password.json');
        $api = 'POST api/set-password';

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->post($api_url, $data);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->status() === 422) {
            return null;
        }

        if ($response->successful()) {
            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function getCurrentUser(?string $access_token, ?array &$current_user): array
    {
        $api_url = 'api/user';
        $response_file_path = storage_path('app/private/responses/get_api_user.json');
        $api = 'GET api/user';

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->get($api_url);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            $current_user = json_decode($response->body());

            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function updateSystemAdmin(?string $access_token, int $user_id, array $data): array
    {
        $api_url = "api/system-admin/$user_id";
        $response_file_path = storage_path('app/private/responses/put_api_system_admin_system_admin.json');
        $api = 'PUT api/system-admin/{system_admin}';

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->put($api_url, $data);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function getApplicationOptions(?string $access_token, ?array &$application_options): array
    {
        $api_url = 'api/application-option';
        $response_file_path = storage_path('app/private/responses/get_api_application_option.json');
        $api = 'GET api/application-option';

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->get($api_url);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            $application_options = json_decode($response->body());

            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function createTenantAdmin(?string $access_token, array $data): array
    {
        $api_url = 'api/tenant-admin';
        $response_file_path = storage_path('app/private/responses/post_api_tenant_admin.json');
        $api = 'POST api/tenant-admin';

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->post($api_url, $data);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function getUsers(?string $access_token, array $data, ?array &$users): array
    {
        $api_url = 'api/users';
        $response_file_path = storage_path('app/private/responses/get_api_users.json');
        $api = 'GET api/users';

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->get($api_url, $data);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            $users = $response->json('data');

            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function getUser(?string $access_token, int $user_id): array
    {
        $api_url = "api/users/$user_id";
        $response_file_path = storage_path('app/private/responses/get_api_users_user.json');
        $api = 'GET api/users/{user}';

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->get($api_url);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function updateTenantAdmin(?string $access_token, int $user_id, array $data): array
    {
        $api_url = "api/tenant-admin/$user_id";
        $response_file_path = storage_path('app/private/responses/put_api_tenant_admin_tenant_admin.json');
        $api = 'PUT api/tenant-admin/{tenant_admin}';

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->put($api_url, $data);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function switchUser(?string $access_token, int $user_id): array
    {
        $api_url = "api/switch-user/$user_id";
        $response_file_path = storage_path('app/private/responses/get_api_switch_user_user.json');
        $api = 'GET api/switch-user/{user}';

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->get($api_url);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function getApplicationClusters(?string $access_token, array $data, ?array &$application_clusters): array
    {
        $api_url = 'api/application-clusters';
        $response_file_path = storage_path('app/private/responses/get_api_application_clusters.json');
        $api = 'GET api/application-clusters';

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->get($api_url, $data);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            $application_clusters = $response->json('data');

            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function updateApplicationCluster(?string $access_token, int $application_cluster_id, array $data): array
    {
        $api_url = "api/application-clusters/$application_cluster_id";
        $response_file_path = storage_path('app/private/responses/put_api_application_clusters_application_cluster.json');
        $api = 'PUT api/application-clusters/{application_cluster}';

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->put($api_url, $data);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function getRealtimeDevice(?string $access_token, int $application_cluster_id): array
    {
        $api_url = "api/applications/$application_cluster_id/realtime/device";
        $response_file_path = storage_path('app/private/responses/get_api_applications_application_cluster_realtime_device.json');
        $api = 'GET api/applications/{application_cluster}/realtime/device';

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->get($api_url);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function getRealtimeData(?string $access_token, int $application_cluster_id, array $data): array
    {
        $api_url = "api/applications/$application_cluster_id/realtime/data";
        $response_file_path = storage_path('app/private/responses/post_api_applications_application_cluster_realtime_data.json');
        $api = 'POST api/applications/{application_cluster}/realtime/data';

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->post($api_url, $data);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function createArea(?string $access_token, array $data): array
    {
        $api_url = 'api/v1/area';
        $response_file_path = storage_path('app/private/responses/post_api_v1_area.json');
        $api = 'POST api/v1/area';

        try {
            $response = Http::baseUrl($this->fast_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->post($api_url, $data);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->body(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function getAreas(?string $access_token, int $application_cluster_id, array $data, ?array &$areas): array
    {
        $api_url = "api/applications/$application_cluster_id/areas";
        $response_file_path = storage_path('app/private/responses/get_api_applications_application_cluster_areas.json');
        $api = 'GET api/applications/{application_cluster}/areas';

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->get($api_url, $data);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            $areas = $response->json('data');

            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function getAreasV2(?string $access_token, string $application_id, string $cluster_id, array $data): array
    {
        $api_url = "api/v2/applications/$application_id/clusters/$cluster_id/areas";
        $response_file_path = storage_path('app/private/responses/get_api_v2_applications_application_clusters_cluster_areas.json');
        $api = 'GET api/v2/applications/{application}/clusters/{cluster}/areas';

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->get($api_url, $data);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function getArea(?string $access_token, int $area_id): array
    {
        $api_url = "api/areas/$area_id";
        $response_file_path = storage_path('app/private/responses/get_api_areas_area.json');
        $api = 'GET api/areas/{area}';

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->get($api_url);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function deleteArea(?string $access_token, int $area_id): array
    {
        $api_url = "api/areas/$area_id";
        $response_file_path = storage_path('app/private/responses/delete_api_areas_area.json');
        $api = 'DELETE api/areas/{area}';

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->delete($api_url);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful() || $response->status() === 409) {
            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function createGrid(?string $access_token, array $data): array
    {
        $api_url = 'api/v1/grid';
        $response_file_path = storage_path('app/private/responses/post_api_v1_grid.json');
        $api = 'POST api/v1/grid';

        try {
            $response = Http::baseUrl($this->fast_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->post($api_url, $data);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->body(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function getGrids(?string $access_token, int $application_cluster_id, array $data, ?array &$grids): array
    {
        $api_url = "api/applications/$application_cluster_id/grids";
        $response_file_path = storage_path('app/private/responses/get_api_applications_application_cluster_grids.json');
        $api = 'GET api/applications/{application_cluster}/grids';

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->get($api_url, $data);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            $grids = $response->json('data');

            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function getGridsV2(?string $access_token, string $application_id, string $cluster_id, array $data): array
    {
        $api_url = "api/v2/applications/$application_id/clusters/$cluster_id/grids";
        $response_file_path = storage_path('app/private/responses/get_api_v2_applications_application_clusters_cluster_grids.json');
        $api = 'GET api/v2/applications/{application}/clusters/{cluster}/grids';

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->get($api_url, $data);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function getGrid(?string $access_token, int $grid_id): array
    {
        $api_url = "api/grids/$grid_id";
        $response_file_path = storage_path('app/private/responses/get_api_grids_grid.json');
        $api = 'GET api/grids/{grid}';

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->get($api_url);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function deleteGrid(?string $access_token, int $grid_id): array
    {
        $api_url = "api/grids/$grid_id";
        $response_file_path = storage_path('app/private/responses/delete_api_grids_grid.json');
        $api = 'DELETE api/grids/{grid}';

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->delete($api_url);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function getWalls(?string $access_token, int $application_cluster_id, array $data, ?array &$walls): array
    {
        $api_url = "api/applications/$application_cluster_id/walls";
        $response_file_path = storage_path('app/private/responses/get_api_applications_application_cluster_walls.json');
        $api = 'GET api/applications/{application_cluster}/walls';

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->get($api_url, $data);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            $walls = $response->json('data');

            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function getWallsV2(?string $access_token, string $application_id, string $cluster_id, array $data): array
    {
        $api_url = "api/v2/applications/$application_id/clusters/$cluster_id/walls";
        $response_file_path = storage_path('app/private/responses/get_api_v2_applications_application_clusters_cluster_walls.json');
        $api = 'GET api/v2/applications/{application}/clusters/{cluster}/walls';

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->get($api_url, $data);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function getWall(?string $access_token, int $wall_id): array
    {
        $api_url = "api/walls/$wall_id";
        $response_file_path = storage_path('app/private/responses/get_api_walls_wall.json');
        $api = 'GET api/walls/{wall}';

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->get($api_url);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function getClusterJoints(?string $access_token, int $application_cluster_id): array
    {
        $api_url = "api/applications/$application_cluster_id/cluster-joints";
        $response_file_path = storage_path('app/private/responses/get_api_applications_application_cluster_cluster_joints.json');
        $api = 'GET api/applications/{application_cluster}/cluster-joints';

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->get($api_url);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function getClusterJointsV2(?string $access_token, string $application_id, string $cluster_id): array
    {
        $api_url = "api/v2/applications/$application_id/clusters/$cluster_id/cluster-joints";
        $response_file_path = storage_path('app/private/responses/get_api_v2_applications_application_clusters_cluster_cluster_joints.json');
        $api = 'GET api/v2/applications/{application}/clusters/{cluster}/cluster-joints';

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->get($api_url);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function editClusterJoints(?string $access_token, int $application_cluster_id, array $data): array
    {
        $api_url = "api/applications/$application_cluster_id/cluster-joints";
        $response_file_path = storage_path('app/private/responses/post_api_applications_application_cluster_cluster_joints.json');
        $api = 'POST api/applications/{application_cluster}/cluster-joints';

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->post($api_url, $data);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function editClusterJointsV2(?string $access_token, string $application_id, string $cluster_id, array $data): array
    {
        $api_url = "api/v2/applications/$application_id/clusters/$cluster_id/cluster-joints";
        $response_file_path = storage_path('app/private/responses/post_api_v2_applications_application_clusters_cluster_cluster_joints.json');
        $api = 'POST api/v2/applications/{application}/clusters/{cluster}/cluster-joints';

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->post($api_url, $data);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function createRoute(?string $access_token, array $data): array
    {
        $api_url = 'api/v1/data';
        $response_file_path = storage_path('app/private/responses/post_api_v1_data.json');
        $api = 'POST api/v1/data';

        try {
            $response = Http::baseUrl($this->fast_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->post($api_url, $data);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->body(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function getRoutes(?string $access_token, array $data, ?array &$routes): array
    {
        $api_url = 'api/routes';
        $response_file_path = storage_path('app/private/responses/get_api_routes.json');
        $api = 'GET api/routes';

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->get($api_url, $data);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            $routes = $response->json('data');

            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function updateRoute(?string $access_token, int $route_id, array $data): array
    {
        $api_url = "api/routes/$route_id";
        $response_file_path = storage_path('app/private/responses/put_api_routes_route.json');
        $api = 'PUT api/routes/{route}';

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->put($api_url, $data);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function getRealtimeAlert(?string $access_token, int $route_id): array
    {
        $api_url = "api/realtime-data/$route_id/alert";
        $response_file_path = storage_path('app/private/responses/get_api_realtime_data_route_alert.json');
        $api = 'GET api/realtime-data/{route}/alert';

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->get($api_url);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function getRouteDataDraw(?string $access_token, int $route_id): array
    {
        $api_url = "api/route-data/$route_id/draw";
        $response_file_path = storage_path('app/private/responses/get_api_route_data_route_draw.json');
        $api = 'GET api/route-data/{route}/draw';

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->get($api_url);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function getRouteDataDevice(?string $access_token, int $route_id): array
    {
        $api_url = "api/route-data/$route_id/device";
        $response_file_path = storage_path('app/private/responses/get_api_route_data_route_device.json');
        $api = 'GET api/route-data/{route}/device';

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->get($api_url);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function getRouteData(?string $access_token, int $route_id, array $data): array
    {
        $api_url = "api/route-data/$route_id/data";
        $response_file_path = storage_path('app/private/responses/post_api_route_data_route_data.json');
        $api = 'POST api/route-data/{route}/data';

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->post($api_url, $data);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function getAnalysisDataDevice(?string $access_token, int $route_id): array
    {
        $api_url = "api/analysis-data/$route_id/device";
        $response_file_path = storage_path('app/private/responses/get_api_analysis_data_route_device.json');
        $api = 'GET api/analysis-data/{route}/device';

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->get($api_url);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function getRoute(?string $access_token, int $route_id): array
    {
        $api_url = "api/routes/$route_id";
        $response_file_path = storage_path('app/private/responses/get_api_routes_route.json');
        $api = 'GET api/routes/{route}';

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->get($api_url);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function toggleRouteBookmark(?string $access_token, int $route_id): array
    {
        $api_url = "api/routes/$route_id/bookmark";
        $response_file_path = storage_path('app/private/responses/post_api_routes_route_bookmark.json');
        $api = 'POST api/routes/{route}/bookmark';

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->post($api_url);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function createAnalysisHistory(?string $access_token, int $route_id, array $data): array
    {
        $api_url = "api/route-data/$route_id/analysis-history";
        $response_file_path = storage_path('app/private/responses/post_api_route_data_route_analysis_history.json');
        $api = 'POST api/route-data/{route}/analysis-history';

        $transfer_time = 0;

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->post($api_url, $data);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function getAnalysisHistories(?string $access_token, int $route_id, ?array &$analysis_histories): array
    {
        $api_url = "api/route-data/$route_id/analysis-history";
        $response_file_path = storage_path('app/private/responses/get_api_route_data_route_analysis_history.json');
        $api = 'GET api/route-data/{route}/analysis-history';

        $transfer_time = 0;

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->get($api_url);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            $analysis_histories = $response->json('history');

            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function getAnalysisHistory(?string $access_token, int $route_id, string $analysis_history_id): array
    {
        $api_url = "api/route-data/$route_id/analysis-history/$analysis_history_id";
        $response_file_path = storage_path('app/private/responses/get_api_route_data_route_analysis_history_analysis_history.json');
        $api = 'GET api/route-data/{route}/analysis-history/{analysis_history}';

        $transfer_time = 0;

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->get($api_url);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function updateAnalysisHistoryPin(?string $access_token, int $route_id, string $analysis_history_id, array $data): array
    {
        $api_url = "api/route-data/$route_id/analysis-history/$analysis_history_id/pin";
        $response_file_path = storage_path('app/private/responses/patch_api_route_data_route_analysis_history_analysis_history_pin.json');
        $api = 'PATCH api/route-data/{route}/analysis-history/{analysis_history}/pin';

        $transfer_time = 0;

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->patch($api_url, $data);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function deleteRoute(?string $access_token, int $route_id): array
    {
        $api_url = "api/routes/$route_id";
        $response_file_path = storage_path('app/private/responses/delete_api_routes_route.json');
        $api = 'DELETE api/routes/{route}';

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->delete($api_url);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function getPositionLogs(?string $access_token, array $data): array
    {
        $api_url = 'api/position-logs';
        $response_file_path = storage_path('app/private/responses/get_api_position_logs.json');
        $api = 'GET api/position-logs';

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->get($api_url, $data);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function getPositionLogBeacons(?string $access_token): array
    {
        $api_url = 'api/position-logs/beacons';
        $response_file_path = storage_path('app/private/responses/get_api_position_logs_beacons.json');
        $api = 'GET api/position-logs/beacons';

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->get($api_url);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function getPositionLogDevices(?string $access_token): array
    {
        $api_url = 'api/position-logs/devices';
        $response_file_path = storage_path('app/private/responses/get_api_position_logs_devices.json');
        $api = 'GET api/position-logs/devices';

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->get($api_url);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function getApplicationClusterOptions(?string $access_token, ?array &$application_cluster_options): array
    {
        $api_url = 'api/application-cluster-option';
        $response_file_path = storage_path('app/private/responses/get_api_application_cluster_option.json');
        $api = 'GET api/application-cluster-option';

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application_cluster/json')
                ->get($api_url);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            $application_cluster_options = json_decode($response->body());

            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function createTenantMember(?string $access_token, array $data): array
    {
        $api_url = 'api/member';
        $response_file_path = storage_path('app/private/responses/post_api_member.json');
        $api = 'POST api/member';

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->post($api_url, $data);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function createTenantStaff(?string $access_token, array $data): array
    {
        $api_url = 'api/staff';
        $response_file_path = storage_path('app/private/responses/post_api_staff.json');
        $api = 'POST api/staff';

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->post($api_url, $data);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function updateTenantMember(?string $access_token, int $user_id, array $data): array
    {
        $api_url = "api/member/$user_id";
        $response_file_path = storage_path('app/private/responses/put_api_member_member.json');
        $api = 'PUT api/member/{member}';

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->put($api_url, $data);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function deleteUser(?string $access_token, int $user_id): array
    {
        $api_url = "api/users/$user_id";
        $response_file_path = storage_path('app/private/responses/delete_api_users_user.json');
        $api = 'DELETE api/users/{user}';

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->delete($api_url);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function updateTenantStaff(?string $access_token, int $user_id, array $data): array
    {
        $api_url = "api/staff/$user_id";
        $response_file_path = storage_path('app/private/responses/put_api_staff_staff.json');
        $api = 'PUT api/staff/{staff}';

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->put($api_url, $data);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function logout(?string $access_token): array
    {
        $api_url = 'api/logout';
        $response_file_path = storage_path('app/private/responses/post_api_logout.json');
        $api = 'POST api/logout';

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->post($api_url);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }

    protected function logoutAll(?string $access_token): array
    {
        $api_url = 'api/logout-all';
        $response_file_path = storage_path('app/private/responses/post_api_logout_all.json');
        $api = 'POST api/logout-all';

        try {
            $response = Http::baseUrl($this->laravel_api)
                ->withOptions([
                    'on_stats' => function (TransferStats $stats) use (&$transfer_time): void {
                        $transfer_time = $stats->getTransferTime();
                    },
                ])
                ->withToken($access_token)
                ->withHeader('Accept', 'application/json')
                ->post($api_url);
        } catch (ConnectionException $exception) {
            File::append($response_file_path, json_encode([
                'message' => $exception->getMessage(),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($response->successful()) {
            File::append($response_file_path, $response->body()."\n");

            return ['api' => $api, 'transfer_time' => $transfer_time, 'created_at' => now(), 'updated_at' => now()];
        } else {
            File::append($response_file_path, json_encode([
                'status' => $response->status(),
                'message' => $response->json('message'),
            ])."\n");

            return ['api' => $api, 'transfer_time' => null, 'created_at' => now(), 'updated_at' => now()];
        }
    }
}
