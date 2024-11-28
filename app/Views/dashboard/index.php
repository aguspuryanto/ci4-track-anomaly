<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
    <style>
    .timeline-item {
        position: relative;
        text-align: center;
    }

    .timeline-time {
        display: inline-block;
        margin-top: 5px;
        font-size: 12px;
    }

    .end-point .timeline-time {
        float: right; /* Memindahkan waktu ke kanan */
        text-align: right;
    }
    </style>

    <div class="xcontainer py-4">
        <!-- <h1 class="text-center mb-4">Project Anomaly Dashboard</h1>-->
        <!-- Menampilkan error jika ada -->
        <?php if (isset($error)): ?>
            <div class="alert alert-danger">
                <?= esc($error) ?>
            </div>
        <?php endif; ?>

        <!-- Menampilkan data events -->        
        <!-- Driver 1 -->
        <?php foreach ($dataObjects as $object): ?>
            <div class="row mb-0">
                <!-- Column 1: Driver Information -->
                <div class="col-md-3">
                    <div class="card mb-3 bg-secondary text-white">
                        <div class="card-body">
                            <h5 class="card-title">Driver Info</h5>
                            <span class="d-block text-white"><strong>Plate:</strong> <?= esc($object['plate_number']) ?></span>
                            <span class="d-block text-white"><strong>Name:</strong> <?= esc($object['name']) ?></span>
                            <span class="d-block text-white"><strong>Route:</strong> Start → End</span>
                        </div>
                    </div>
                </div>

                <!-- Column 2: Timeline -->
                <div class="col-md-9">
                    <div class="card mb-0 bg-secondary text-white">
                        <div class="card-body">
                            <div class="timeline mb-0 text-center">
                                <?php foreach ($object['timeline'] as $event): ?>
                                <?php
                                    $shouldHideBadge = ($event['location'] === 'End Point');
                                    $scheduledTime = date('H:i', strtotime($event['scheduled_time']));
                                    $actualedTime = date('H:i', strtotime($event['actual_time']));
                                    $badgeClass = $shouldHideBadge ? 'd-none' : '';
                                    $badgeStatus = ($scheduledTime == $actualedTime) ? 'bg-success' : 'bg-danger';
                                ?>
                                <div class="timeline-item <?=($shouldHideBadge) ? 'end-point' : ''; ?>">
                                    <p><?= esc($event['location']) ?></p>
                                    <div class="timeline-point"></div>
                                    <div class="hstack gap-2">
                                        <span class="badge bg-secondary <?= $badgeClass; ?>"><?= $scheduledTime; ?></span>
                                        <div class="vr <?= $badgeClass; ?>"></div>
                                        <span class="badge <?= $badgeStatus; ?> timeline-time"><?= $actualedTime; ?></span>
                                    </div>
                                </div>
                                <div class="timeline-bar"></div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <!-- Driver 5 -->
        <div class="row mb-0 d-none">
            <div class="col-md-3">
                <div class="card mb-3 bg-secondary text-white">
                    <div class="card-body">
                        <h5 class="card-title">Driver Info</h5>
                        <span class="d-block text-white"><strong>Plate:</strong> B 3456 JKL</span>
                        <span class="d-block text-white"><strong>Name:</strong> Pak Eko</span>
                        <span class="d-block text-white"><strong>Route:</strong> Start → End</span>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card mb-0 bg-secondary text-white">
                    <div class="card-body">
                        <div class="timeline mb-0 text-center">
                            <!-- Start Point -->
                            <div class="timeline-item">
                                <div class="timeline-point"></div>
                                <!-- <div class="location-time"> -->
                                <p>Start Point</p>
                                <span class="badge status status-green">08:00</span>
                                <!-- </div> -->
                            </div>
                            <div class="timeline-bar"></div>
                            <!-- Location A -->
                            <div class="timeline-item">
                                <div class="timeline-point"></div>
                                <!-- <div class="location-time"> -->
                                <p>Location A</p>
                                <span class="badge status status-green">10:30</span>
                            </div>
                            <div class="timeline-bar"></div>
                            <!-- Location B -->
                            <div class="timeline-item">
                            <div class="timeline-point"></div>
                                <!-- <div class="location-time"> -->
                                <p>Location B</p>
                                <span class="badge status status-green">12:10</span>
                            </div>
                            <div class="timeline-bar"></div>
                            <!-- Location C -->
                            <div class="timeline-point"></div>
                            <div class="location-time">
                                <p>Location C</p>
                                <span class="badge status status-green">13:00</span>
                            </div>
                            <div class="timeline-bar"></div>
                            <!-- Location D -->
                            <div class="timeline-point"></div>
                            <div class="location-time">
                                <p>Location D</p>
                                <span class="badge status status-red">14:00</span>
                            </div>
                            <div class="timeline-bar"></div>
                            <!-- Location E -->
                            <div class="timeline-point"></div>
                            <div class="location-time">
                                <p>Location E</p>
                                <span class="badge status status-green">14:30</span>
                            </div>
                            <div class="timeline-bar"></div>
                            <!-- End Point -->
                            <div class="timeline-point"></div>
                            <div class="location-time">
                                <p>End Point</p>
                                <span class="badge status status-green">21:00</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

<?= $this->endSection() ?>
