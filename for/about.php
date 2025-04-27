<?php include "header.php"; ?>
<!-- ***** Breadcrumb Area Start ***** -->
<section class="section breadcrumb-area d-flex align-items-center" style="background: rgb(16 36 18);">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-content d-flex flex-column align-items-center text-center">
                    <h2 class="text-white text-uppercase mb-3">نتائج المباريات</h2>
                    <ol class="breadcrumb d-flex justify-content-center">
                        <li class="breadcrumb-item text-white active">نتائج المباريات</li>
                        <li class="breadcrumb-item"><a class="text-uppercase text-white" href="index.php">الرئيسية</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ***** Breadcrumb Area End ***** -->

<!-- Match Results Section -->
<section class="match-results-section py-5" style="background: #F5F5F5;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading text-center mb-5">
                    <h2 class="fw-bold" style="color: #245C36;">كأس العالم 2034</h2>
                    <p class="text-muted">أحدث نتائج مباريات كأس العالم</p>
                </div>
                
                <?php
                // Specify your JSON file path
                $jsonFile = 'worldcup.json';
                
                if (file_exists($jsonFile)) {
                    $jsonData = file_get_contents($jsonFile);
                    $data = json_decode($jsonData, true);
                    
                    if ($data && isset($data['matches']) && is_array($data['matches'])) {
                        // Group matches by round
                        $groupedMatches = [];
                        foreach ($data['matches'] as $match) {
                            $round = $match['round'] ?? 'Unknown Round';
                            $groupedMatches[$round][] = $match;
                        }
                        
                        // Display matches by round
                        foreach ($groupedMatches as $round => $roundMatches) {
                            echo '<div class="round-section mb-5">';
                            echo '<div class="round-header p-3 mb-3 rounded" style="background: #245C36; color: white;">';
                            echo '<h4 class="round-title mb-0 fw-bold">' . htmlspecialchars($round) . '</h4>';
                            echo '</div>';
                            echo '<div class="row">';
                            
                            foreach ($roundMatches as $match) {
                                // Generate random scores between 1-4
                                $team1_score = rand(1, 4);
                                $team2_score = rand(1, 4);
                                
                                echo '<div class="col-md-6 col-lg-4 mb-4">';
                                echo '<div class="match-card card h-100 border-0 shadow-sm" style="border-left: 4px solid #245C36 !important;">';
                                echo '<div class="card-body p-3" style="background: white;">';
                                
                                // Match date
                                if (!empty($match['date'])) {
                                    echo '<div class="match-date mb-2" style="color: #245C36;">';
                                    echo '<i class="far fa-calendar-alt me-2"></i>' . htmlspecialchars($match['date']);
                                    echo '</div>';
                                }
                                
                                // Teams and scores
                                echo '<div class="teams-container">';
                                
                                // Team 1
                                echo '<div class="team d-flex align-items-center justify-content-between mb-2">';
                                echo '<div class="team-name fw-bold" style="color: #245C36;">' . htmlspecialchars($match['team1']) . '</div>';
                                echo '<div class="team-score text-white px-2 rounded" style="background: #245C36;">' . $team1_score . '</div>';
                                echo '</div>';
                                
                                // Team 2
                                echo '<div class="team d-flex align-items-center justify-content-between">';
                                echo '<div class="team-name fw-bold" style="color: #245C36;">' . htmlspecialchars($match['team2']) . '</div>';
                                echo '<div class="team-score text-white px-2 rounded" style="background: #245C36;">' . $team2_score . '</div>';
                                echo '</div>';
                                
                                echo '</div>'; // teams-container
                                
                                // Stadium
                                if (!empty($match['stadium'])) {
                                    echo '<div class="stadium mt-3 pt-2 border-top">';
                                    echo '<small style="color: #245C36;"><i class="fas fa-map-marker-alt me-2"></i> ' . htmlspecialchars($match['stadium']) . '</small>';
                                    echo '</div>';
                                }
                                
                                echo '</div>'; // card-body
                                echo '</div>'; // match-card
                                echo '</div>'; // col
                            }
                            
                            echo '</div>'; // row
                            echo '</div>'; // round-section
                        }
                    } else {
                        echo '<div class="alert alert-warning">لا توجد بيانات مباريات متاحة حالياً.</div>';
                    }
                } else {
                    echo '<div class="alert alert-danger">ملف النتائج غير موجود: ' . htmlspecialchars($jsonFile) . '</div>';
                }
                ?>
            </div>
        </div>
    </div>
</section>

<style>
.match-card {
    border-radius: 8px;
    transition: all 0.3s ease;
    border: 1px solid #e0e0e0;
}
.match-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}
.round-header {
    border-left: 4px solid white;
}
.team {
    padding: 8px 0;
}
.team-name {
    font-size: 1.1rem;
}
.team-score {
    min-width: 30px;
    text-align: center;
    font-weight: bold;
}
.match-date {
    font-size: 0.9rem;
}
.stadium {
    font-size: 0.85rem;
}
/* KSA-inspired colors */
:root {
    --ksa-green: #245C36;
    --ksa-white: #FFFFFF;
    --ksa-light-bg: #F5F5F5;
}
</style>

<?php include "footer.php"; ?>