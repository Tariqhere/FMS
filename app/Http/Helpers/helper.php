<?php

function getDispatchStatus($status)
    {
        $statuses = [
            0 => 'Submit',
            1 => 'Approve',
            2 => 'Reject',
            3 => 'Return',
            4 => 'Recommend',
        ];
        
    return $statuses[$status] ?? 'Unknown';
    }