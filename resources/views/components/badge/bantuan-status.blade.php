<x-badge value="{{ $status }}" :options="[
    (object) [
        'type' => 'primary',
        'value' => 'DITERIMA',
    ],
    (object) [
        'type' => 'success',
        'value' => 'DISETUJUI',
    ],
    (object) [
        'type' => 'secondary',
        'value' => 'DIAJUKAN',
    ],
    (object) [
        'type' => 'danger',
        'value' => 'DITOLAK',
    ]
]" />