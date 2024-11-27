<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
    <!-- <h1>Welcome to the Dashboard, <?= session()->get('user') ?>!</h1>
    <a href="/logout" class="btn btn-danger mt-3">Logout</a> -->
    <?php 
    // $dataObjects = (json_decode($objects, true));
    ?>
    
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
                                <!-- Start Point -->
                                <div class="timeline-item">
                                    <p>Start Point</p>
                                    <div class="timeline-point"></div>
                                    <div class="hstack gap-2">
                                        <span class="badge bg-secondary">08:00</span>
                                        <div class="vr"></div>
                                        <span class="badge bg-success">08:00</span>
                                    </div>
                                </div>
                                <div class="timeline-bar"></div>
                                <!-- Location A -->
                                <div class="timeline-item">
                                    <p>Location A</p>
                                    <div class="timeline-point"></div>
                                    <div class="hstack gap-2">
                                        <span class="badge bg-secondary">10:30</span>
                                        <div class="vr"></div>
                                        <span class="badge status status-green">10:30</span>
                                    </div>
                                </div>
                                <div class="timeline-bar"></div>
                                <!-- Location B -->
                                <div class="timeline-item">
                                    <p>Location B</p>
                                    <div class="timeline-point"></div>
                                    <div class="hstack gap-2">
                                        <span class="badge bg-secondary">12:10</span>
                                        <div class="vr"></div>
                                        <span class="badge status status-green">12:10</span>
                                    </div>
                                </div>
                                <div class="timeline-bar"></div>
                                <!-- Location C -->
                                <div class="location-time">
                                    <p>Location C</p>
                                    <div class="timeline-point"></div>
                                    <div class="hstack gap-2">
                                        <span class="badge bg-secondary">13:00</span>
                                        <div class="vr"></div>
                                        <span class="badge status status-green">13:00</span>
                                    </div>
                                </div>
                                <div class="timeline-bar"></div>
                                <!-- Location D -->
                                <div class="location-time">
                                    <p>Location D</p>
                                    <div class="timeline-point"></div>
                                    <div class="hstack gap-2">
                                        <span class="badge bg-secondary">14:00</span>
                                        <div class="vr"></div>
                                        <span class="badge bg-danger">14:10</span>
                                    </div>
                                </div>
                                <div class="timeline-bar"></div>
                                <!-- Location E -->
                                <div class="location-time">
                                    <p>Location E</p>
                                    <div class="timeline-point"></div>
                                    <div class="hstack gap-2">
                                        <span class="badge bg-secondary">14:30</span>
                                        <div class="vr"></div>
                                        <span class="badge status status-green">14:30</span>
                                    </div>
                                </div>
                                <div class="timeline-bar"></div>
                                <!-- End Point -->
                                <div class="location-time">
                                    <p>End Point</p>
                                    <div class="timeline-point"></div>
                                    <div class="hstack gap-2">
                                        <span class="badge status status-green">21:00</span>
                                    </div>
                                </div>
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
