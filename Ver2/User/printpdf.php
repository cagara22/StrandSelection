<?php
    session_start();

    require_once '../vendor/autoload.php';
    include 'connection.php';

    use Dompdf\Dompdf;
    use Dompdf\Options;

    if(isset($_GET['lrn'])){
        $lrn = $_GET['lrn'];

        $res_sql = "SELECT sp.*, s.sectionName, sy.schoolyrName, r.*, 
                sr.acadProb AS acadProbStem, 
                sr.intProb AS intProbStem, 
                sr.carProb AS carProbStem, 
                sr.skiProb AS skiProbStem, 
                sr.totalScore AS totalScoreStem, 
                sr.percScore AS percScoreStem, 
                hr.acadProb AS acadProbHumss, 
                hr.intProb AS intProbHumss, 
                hr.carProb AS carProbHumss, 
                hr.skiProb AS skiProbHumss, 
                hr.totalScore AS totalScoreHumss, 
                hr.percScore AS percScoreHumss, 
                ar.acadProb AS acadProbAbm, 
                ar.intProb AS intProbAbm, 
                ar.carProb AS carProbAbm, 
                ar.skiProb AS skiProbAbm, 
                ar.totalScore AS totalScoreAbm, 
                ar.percScore AS percScoreAbm, 
                gr.acadProb AS acadProbGas, 
                gr.intProb AS intProbGas, 
                gr.carProb AS carProbGas, 
                gr.skiProb AS skiProbGas, 
                gr.totalScore AS totalScoreGas, 
                gr.percScore AS percScoreGas, 
                tr.acadProb AS acadProbTvlict, 
                tr.intProb AS intProbTvlict, 
                tr.carProb AS carProbTvlict, 
                tr.skiProb AS skiProbTvlict, 
                tr.totalScore AS totalScoreTvlict, 
                tr.percScore AS percScoreTvlict, 
                tlr.acadProb AS acadProbTvlhe, 
                tlr.intProb AS intProbTvlhe, 
                tlr.carProb AS carProbTvlhe, 
                tlr.skiProb AS skiProbTvlhe, 
                tlr.totalScore AS totalScoreTvlhe, 
                tlr.percScore AS percScoreTvlhe 
        FROM studentprofile sp
        JOIN section s ON sp.sectionID = s.sectionID
        JOIN schoolyr sy ON sp.sectionID = sy.schoolyrID
        JOIN result r ON sp.lrn = r.lrn 
        JOIN stemresult sr ON sp.lrn = sr.lrn 
        JOIN humssresult hr ON sp.lrn = hr.lrn 
        JOIN abmresult ar ON sp.lrn = ar.lrn 
        JOIN gasresult gr ON sp.lrn = gr.lrn 
        JOIN tvlictresult tr ON sp.lrn = tr.lrn 
        JOIN tvlheresult tlr ON sp.lrn = tlr.lrn 
        WHERE sp.lrn = '$lrn'";

        $result = $conn->query($res_sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $fname = $row['Fname'];
                $mname = $row['Mname'];
                $lname = $row['Lname'];
                $suffix = $row['suffix'];
                $sex = $row['sex'];
                $bday = $row['bday'];
                $age = $row['age'];
                $section = $row['sectionName'];
                $schoolyr = $row['schoolyrName'];
                $recStrand = $row['MostSuitableStrand'];
                $currentDateTime = date("Y-m-d", time());

                $recommendation = $row['recommendation'];

                $ovrSTEM = $row['percScoreStem'];
                $ovrHUMSS = $row['percScoreHumss'];
                $ovrABM = $row['percScoreAbm'];
                $ovrGAS = $row['percScoreGas'];
                $ovrTVLICT = $row['percScoreTvlict'];
                $ovrTVLHE = $row['percScoreTvlhe'];

                $skiSTEM = $row['skiProbStem'];
                $skiHUMSS = $row['skiProbHumss'];
                $skiABM = $row['skiProbAbm'];
                $skiGAS = $row['skiProbGas'];
                $skiTVLICT = $row['skiProbTvlict'];
                $skiTVLHE = $row['skiProbTvlhe'];

                $intSTEM = $row['intProbStem'];
                $intHUMSS = $row['intProbHumss'];
                $intABM = $row['intProbAbm'];
                $intGAS = $row['intProbGas'];
                $intTVLICT = $row['intProbTvlict'];
                $intTVLHE = $row['intProbTvlhe'];

                $acadSTEM = $row['acadProbStem'];
                $acadHUMSS = $row['acadProbHumss'];
                $acadABM = $row['acadProbAbm'];
                $acadGAS = $row['acadProbGas'];
                $acadTVLICT = $row['acadProbTvlict'];
                $acadTVLHE = $row['acadProbTvlhe'];

                $carSTEM = $row['carProbStem'];
                $carHUMSS = $row['carProbHumss'];
                $carABM = $row['carProbAbm'];
                $carGAS = $row['carProbGas'];
                $carTVLICT = $row['carProbTvlict'];
                $carTVLHE = $row['carProbTvlhe'];
            }
        }

        $options = new Options();
        $options->setChroot(__DIR__);
        $options->setIsRemoteEnabled(true);

        $dompdf = new Dompdf($options);

        $dompdf->setPaper("Legal", "landscape");

        $html = "<!DOCTYPE html>
        <html>
        <head>
            <meta charset='UTF-8'>
            <link rel='stylesheet' href='https://unpkg.com/gutenberg-css@0.6'>
            <style>
                body{
                    font-family: Arial, sans-serif;
                }
                h5 {
                    margin: 1px;
                }
                table.studentDetails{
                    border: none;
                    border-collapse: collapse;
                    width: 100%;
                    margin-bottom: 20px;
                }
                td.studentDetails{
                    padding: 1px;
                    border: none;
                }
                table.studentResults{
                    border-collapse: collapse;
                    width: 100%;
                }
                th.studentResults{
                    font-size: 14px;
                    background-color: #f2f2f2;
                    border: 1px solid #dddddd;
                    text-align: center;
                    font-weight: bold;
                }
                td.studentResults{
                    font-size: 13px;
                    border: 1px solid #dddddd;
                    text-align: center;
                    padding: 8px;
                }
                td.studentReco{
                    font-size: 13px;
                    border: 1px solid #dddddd;
                    text-align: left;
                    padding: 8px;
                }
                footer {
                    text-align: center;
                    font-style: italic;
                }
            </style>
        </head>
        <body>
            
            <div style='position: relative; text-align: center; margin-bottom: 20px;'>
                <div style='position: relative; margin-left: 80px; margin-right: 80px;'>
                    <img src='./images/GUIDE_Logo_1.png' style='position: absolute; left: 380px; width: 80px; height: 70px;'>
                    <img src='./images/LNHSlogo.png' style='position: absolute; right: 380px; width: 70px; height: 70px;'>
                    <h5>Republic of the Philippines</h5>
                    <h5>Department of Education</h5>
                    <h5>Leyte National High School</h5>
                    <h5>Tacloban City</h5>
                </div>
            </div>
        
        
            
            <h1 style='text-align: center;'>GUIDE Strand Compatibility Results</h1>
        
            <table class='studentDetails'>
                <tbody>
                    <tr>
                        <td class='studentDetails'><b>LRN:</b> ". $lrn ."</td>
                        <td class='studentDetails'><b>First Name:</b> ". $fname ."</td>
                        <td class='studentDetails'><b>Middle Name:</b> ". $mname ."</td>
                        <td class='studentDetails'><b>Last Name:</b> ". $lname ."</td>
                        <td class='studentDetails'><b>Suffix:</b> ". $suffix ."</td>
                    </tr>
                    <tr>
                        <td class='studentDetails'><b>Sex:</b> ". $sex ."</td>
                        <td class='studentDetails'><b>Birthday:</b> ". $bday ."</td>
                        <td class='studentDetails'><b>Age:</b> ". $age ."</td>
                        <td class='studentDetails'><b>Section:</b> ". $section ."</td>
                        <td class='studentDetails'><b>School Year:</b> ". $schoolyr ."</td>
                    </tr>
                    <tr>
                        <td class='studentDetails' colspan='3'><b>Recommended Strand:</b> ". $recStrand ."</td>
                        <td class='studentDetails' colspan='2'><b>Date Printed:</b> ". $currentDateTime ."</td>
                    </tr>
                </tbody>
            </table>
        
            <table class='studentResults'>
                <thead>
                    <tr>
                        <th class='studentResults'>Criteria</th>
                        <th class='studentResults'>STEM</th>
                        <th class='studentResults'>HUMSS</th>
                        <th class='studentResults'>ABM</th>
                        <th class='studentResults'>GAS</th>
                        <th class='studentResults'>TVL-ICT</th>
                        <th class='studentResults'>TVL-HE</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class='studentResults'><b>OVERALL</b></td>
                        <td class='studentResults'>". $ovrSTEM ."</td>
                        <td class='studentResults'>". $ovrHUMSS ."</td>
                        <td class='studentResults'>". $ovrABM ."</td>
                        <td class='studentResults'>". $ovrGAS ."</td>
                        <td class='studentResults'>". $ovrTVLICT ."</td>
                        <td class='studentResults'>". $ovrTVLHE ."</td>
                    </tr>
                    <tr>
                        <td class='studentResults'><b>SKILLS</b></td>
                        <td class='studentResults'>". $skiSTEM ."</td>
                        <td class='studentResults'>". $skiHUMSS ."</td>
                        <td class='studentResults'>". $skiABM ."</td>
                        <td class='studentResults'>". $skiGAS ."</td>
                        <td class='studentResults'>". $skiTVLICT ."</td>
                        <td class='studentResults'>". $skiTVLHE ."</td>
                    </tr>
                    <tr>
                        <td class='studentResults'><b>INTERESTS</b></td>
                        <td class='studentResults'>". $intSTEM ."</td>
                        <td class='studentResults'>". $intHUMSS ."</td>
                        <td class='studentResults'>". $intABM ."</td>
                        <td class='studentResults'>". $intGAS ."</td>
                        <td class='studentResults'>". $intTVLICT ."</td>
                        <td class='studentResults'>". $intTVLHE ."</td>
                    </tr>
                    <tr>
                        <td class='studentResults'><b>ACADEMIC PERFORMANCE</b></td>
                        <td class='studentResults'>". $acadSTEM ."</td>
                        <td class='studentResults'>". $acadHUMSS ."</td>
                        <td class='studentResults'>". $acadABM ."</td>
                        <td class='studentResults'>". $acadGAS ."</td>
                        <td class='studentResults'>". $acadTVLICT ."</td>
                        <td class='studentResults'>". $acadTVLHE ."</td>
                    </tr>
                    <tr>
                        <td class='studentResults'><b>CAREER</b></td>
                        <td class='studentResults'>". $carSTEM ."</td>
                        <td class='studentResults'>". $carHUMSS ."</td>
                        <td class='studentResults'>". $carABM ."</td>
                        <td class='studentResults'>". $carGAS ."</td>
                        <td class='studentResults'>". $carTVLICT ."</td>
                        <td class='studentResults'>". $carTVLHE ."</td>
                    </tr>
                    <tr>
                        <td class='studentReco' colspan='7'><b>RECOMMENDATION:</b> ". $recommendation ."</td>
                    </tr>
                </tbody>
            </table>
        </body>
        </html>";

        $dompdf->loadHtml($html);

        $dompdf->render();

        $dompdf->addInfo("Title", "GUIDE Strand Compatibility Results");

        $filename = $lrn . " GUIDE_Strand_Compatibility_Results";

        $dompdf->stream($filename, ["Attachment" => 0]);
    }
?>