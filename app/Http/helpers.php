<?php

function status($status)
{
    switch ($status) {
        case 'good':
            return 'green';
        case 'bad':
            return 'amber darken-2';
        case 'critical':
            return 'red';
    }
}

function getStatusList()
{
    return $statuses = [
        'good'     => 'Good',
        'bad'      => 'Unsatisfactory',
        'critical' => 'Critical',
    ];
}
