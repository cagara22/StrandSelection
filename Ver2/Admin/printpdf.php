<?php
    session_start();

    require_once '../vendor/autoload.php';
    include 'connection.php';

    use Dompdf\Dompdf;
    use Dompdf\Options;

    if(isset($_GET['schoolyrID']) && isset($_GET['schoolyrName'])){
        $schoolyrID = $_GET['schoolyrID'];
        $schoolyrName = $_GET['schoolyrName'];
        $adminFullname = $_SESSION['fullname'];
        $currentDateTime = date("Y-m-d", time());

        $options = new Options();
        $options->setChroot(__DIR__);
        $options->setIsRemoteEnabled(true);

        $dompdf = new Dompdf($options);

        $dompdf->setPaper("Legal", "landscape");

        $countStrand_sql = "SELECT 
                schoolyrID, 
                SUM(CASE WHEN result.MostSuitableStrand = 'STEM' THEN 1 ELSE 0 END) AS STEM_count, 
                SUM(CASE WHEN result.MostSuitableStrand = 'HUMSS' THEN 1 ELSE 0 END) AS HUMSS_count, 
                SUM(CASE WHEN result.MostSuitableStrand = 'ABM' THEN 1 ELSE 0 END) AS ABM_count, 
                SUM(CASE WHEN result.MostSuitableStrand = 'GAS' THEN 1 ELSE 0 END) AS GAS_count, 
                SUM(CASE WHEN result.MostSuitableStrand = 'TVL-ICT' THEN 1 ELSE 0 END) AS TVLICT_count, 
                SUM(CASE WHEN result.MostSuitableStrand = 'TVL-HE' THEN 1 ELSE 0 END) AS TVLHE_count 
            FROM 
                studentprofile
            JOIN
                result ON studentprofile.lrn = result.lrn
            WHERE 
                schoolyrID = '". $schoolyrID ."'
            GROUP BY 
                schoolyrID";

        $countStrand_result = $conn->query($countStrand_sql);
        if($countStrand_result->num_rows > 0){
            $countStrand_row = $countStrand_result->fetch_assoc();
            $count_stem = $countStrand_row['STEM_count'];
            $count_humss = $countStrand_row['HUMSS_count'];
            $count_abm = $countStrand_row['ABM_count'];
            $count_gas = $countStrand_row['GAS_count'];
            $count_tvlict = $countStrand_row['TVLICT_count'];
            $count_tvlhe = $countStrand_row['TVLHE_count'];
        }else{
            $count_stem = 0;
            $count_humss = 0;
            $count_abm = 0;
            $count_gas = 0;
            $count_tvlict = 0;
            $count_tvlhe = 0;
        }

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
                table {
                    border-collapse: collapse;
                    width: 100%;
                }
                th {
                    font-size: 14px;
                    background-color: #f2f2f2;
                    border: 1px solid #dddddd;
                    text-align: center;
                    font-weight: bold;
                }
                td {
                    font-size: 13px;
                    border: 1px solid #dddddd;
                    text-align: center;
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
            
            <p>School Year: ". $schoolyrName ."</p>
            <p>Printed by: ". $adminFullname ."</p>
            <p>Date Printed: ". $currentDateTime ."</p>
        
            <h3 style='text-align: center;'>Summary</h3>
            <table>
                <thead>
                    <th>STEM</th>
                    <th>HUMSS</th>
                    <th>ABM</th>
                    <th>GAS</th>
                    <th>TVL-ICT</th>
                    <th>TVL-HE</th>
                </thead>
                <tbody>
                    <td>". $count_stem ."</td>
                    <td>". $count_humss ."</td>
                    <td>". $count_abm ."</td>
                    <td>". $count_gas ."</td>
                    <td>". $count_tvlict ."</td>
                    <td>". $count_tvlhe ."</td>
                </tbody>
            </table>
        
            <h3 style='text-align: center;'>List</h3>
            <table>
                <thead>
                    <tr>
                        <th>LRN</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name</th>
                        <th>Suffix</th>
                        <th>Age</th>
                        <th>Sex</th>
                        <th>Section</th>
                        <th>Most Suitable Strand</th>
                        <th>STEM</th>
                        <th>HUMSS</th>
                        <th>ABM</th>
                        <th>GAS</th>
                        <th>TVL-ICT</th>
                        <th>TVL-HE</th>
                        
                    </tr>
                </thead>
                <tbody>";

                $list_sql = "SELECT studentprofile.lrn, studentprofile.Fname, studentprofile.Mname, studentprofile.Lname, studentprofile.suffix, studentprofile.age, studentprofile.sex, section.sectionName, result.MostSuitableStrand, stemresult.percScore AS 'STEMRes', humssresult.percScore AS 'HUMSSRes', abmresult.percScore AS 'ABMRes', gasresult.percScore AS 'GASRes', tvlictresult.percScore AS 'TVLICTRes', tvlheresult.percScore AS 'TVLHERes' FROM studentprofile
                JOIN section ON studentprofile.sectionID = section.sectionID
                JOIN result ON studentprofile.lrn = result.lrn
                JOIN stemresult ON studentprofile.lrn = stemresult.lrn
                JOIN humssresult ON studentprofile.lrn = humssresult.lrn
                JOIN abmresult ON studentprofile.lrn = abmresult.lrn
                JOIN gasresult ON studentprofile.lrn = gasresult.lrn
                JOIN tvlictresult ON studentprofile.lrn = tvlictresult.lrn
                JOIN tvlheresult ON studentprofile.lrn = tvlheresult.lrn
                WHERE studentprofile.schoolyrID = '". $schoolyrID ."'
                AND result.MostSuitableStrand <> ''
                ORDER BY studentprofile.sectionID;";

                $list_result = $conn->query($list_sql);
                if ($list_result->num_rows > 0) {
                    while ($row = $list_result->fetch_assoc()) {
                        $html .= "<tr>
                        <td>". $row['lrn'] ."</td>
                        <td>". $row['Fname'] ."</td>
                        <td>". $row['Mname'] ."</td>
                        <td>". $row['Lname'] ."</td>
                        <td>". $row['suffix'] ."</td>
                        <td>". $row['age'] ."</td>
                        <td>". $row['sex'] ."</td>
                        <td>". $row['sectionName'] ."</td>
                        <td>". $row['MostSuitableStrand'] ."</td>
                        <td>". $row['STEMRes'] ."</td>
                        <td>". $row['HUMSSRes'] ."</td>
                        <td>". $row['ABMRes'] ."</td>
                        <td>". $row['GASRes'] ."</td>
                        <td>". $row['TVLICTRes'] ."</td>
                        <td>". $row['TVLHERes'] ."</td>
                    </tr>";
                    }
                }else{
                    $html .= "<tr><td colspan='15' >0 results</td></tr>";
                }

                $html .= "</tbody>
                </table>
                
                <footer>
                    --END OF DOCUMENT--
                </footer>
                
            </body>
            </html>";

        $dompdf->loadHtml($html);

        $dompdf->render();

        $dompdf->addInfo("Title", "GUIDE Strand Compatibility Results");

        $filename = $schoolyrName . " GUIDE_Strand_Compatibility_Results";

        $dompdf->stream($filename, ["Attachment" => 0]);
    }
?>