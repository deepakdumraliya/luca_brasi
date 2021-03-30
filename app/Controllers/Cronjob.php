<?php

namespace App\Controllers;

require_once ROOTPATH . '/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
/**
 * Cronjob controller used to create cronjob 
 */
class Cronjob extends BaseController
{
    /**
     * index method is the first method to be getting loaded and display login page
     */
    /**
     * Instance of the main Request object.
     *
     * @var HTTP\IncomingRequest
     */
    protected $request;
    protected  $year;
    protected  $month;
    protected   $day;
    protected $spreadsheet;
    protected $email;
    public function __construct()
    {
        $this->year = date("Y");
        $this->month = date("m");
        $this->day = date("d");
        $this->spreadsheet = new Spreadsheet();
        $this->email = \Config\Services::email();
    }
    public function index()
    {
        echo "cronjob";
    }
    public function getdays()
    {
        $days = array();
        for ($i = 1; $i < $this->day; $i++) {
            $date = date("l", mktime(0, 0, 0, $this->month, $i, $this->year));
            array_push($days, $date);
        }
        foreach ($days as $key => $day) {
            if ($day == "Monday") {
                $days[$key] = "Montag";
            }
            if ($day == "Tuesday") {
                $days[$key] = "Dienstag";
            }
            if ($day == "Wednesday") {
                $days[$key] = "Mittwoch";
            }
            if ($day == "Thursday") {
                $days[$key] = "Donnerstag";
            }
            if ($day == "Friday") {
                $days[$key] = "Freitag";
            }
            if ($day == "Saturday") {
                $days[$key] = "Samstag";
            }
            if ($day == "Sunday") {
                $days[$key] = "Sonntag";
            }
        }
        return $days;
    }
    public function getdate()
    {
        $dateword = array();
        for ($i = 1; $i < $this->day; $i++) {
            $daykey = date("d-m-Y", mktime(0, 0, 0, $this->month, $i, $this->year));
            array_push($dateword, $daykey);
        }
        return $dateword;
    }
    public function getdrivers()
    {
        $employee = $this->db->table('tbl_user')->where('type_id', 0)->get()->getResultArray();
        return $employee;
    }
    public function getgermonmonth()
    {
        $month = date("m", mktime(0, 0, 0, $this->month, $this->day, $this->year));
        $germanmonth = "";
        if ($month == "01") {
            $germanmonth = "Januar";
        }
        if ($month == "02") {
            $germanmonth = "Februar";
        }
        if ($month == "03") {
            $germanmonth = "März";
        }
        if ($month == "04") {
            $germanmonth = "April";
        }
        if ($month == "05") {
            $germanmonth = "Mai";
        }
        if ($month == "06") {
            $germanmonth = "Juni";
        }
        if ($month == "07") {
            $germanmonth = "Juli";
        }
        if ($month == "08") {
            $germanmonth = "August";
        }
        if ($month == "09") {
            $germanmonth = "September";
        }
        if ($month == "10") {
            $germanmonth = "Oktober";
        }
        if ($month == "11") {
            $germanmonth = "November";
        }
        if ($month == "12") {
            $germanmonth = "Dezember";
        }
        return $germanmonth;
    }
    public function gettime($start, $end)
    {
        $dateTimeObject1 = date_create($start);
        $dateTimeObject2 = date_create($end);
        $difference = date_diff($dateTimeObject1, $dateTimeObject2);
        return (float)$difference->format('%h.%i');
    }
    public function genratexcel()
    {
        // (C) GET WORKSHEET
        $sheet = $this->spreadsheet->getActiveSheet();
        $styleheader = [
            'font' => [
                'bold' => true,
                'size' => 16
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                ],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'rotation' => 90,
                'startColor' => [
                    'argb' => 'c4d79b',
                ]
            ],
        ];
        $styleheaderdetails = [
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'rotation' => 90,
                'startColor' => [
                    'argb' => 'ebf1de',
                ]
            ],
        ];
        $styleheaderdetailsjob = [
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];
        $styleheaderdetailsdata = [
            
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];
        $employees = $this->getdrivers();
        $days = $this->getdays();
        $dateword = $this->getdate();
        foreach ($employees as $key => $emp) {
            $sheet = $this->spreadsheet->getSheet($key);
            $sheet->setTitle($emp['first_name'] . " " . $emp['last_name']);
            $excelsheet = array();
            $workingdays = $this->db->table('driving_day')->where('user_id', $emp['user_id'])->join('tbl_car', 'tbl_car.car_id=driving_day.car_id')->join('destinations', 'driving_day.destincation_id=destinations.destination_id')->get()->getResultArray();
            for ($i = 0; $i < count($days); $i++) {
                //  start_timestamp
                $dayrecord = array($days[$i], $dateword[$i]);
                foreach ($workingdays as $work) {
                   
                    if ($dateword[$i] == date("d-m-Y", strtotime($work['start_timestamp']))) {
                        if ($work['start_timestamp'] != "") {
                            if ($work['end_timestamp'] == "") {
                                $dayrecord = array($days[$i], $dateword[$i], date("h:m", strtotime($work['start_timestamp'])), " - ", " - ");
                            } else {
                                $dayrecord = array($days[$i], $dateword[$i], date("h:m", strtotime($work['start_timestamp'])), date("h:m", strtotime($work['end_timestamp'])), $this->gettime($work['start_timestamp'], $work['end_timestamp']), $work['car_noplate'], $work['name']);
                            }
                           
                        }
                    }
                }
                array_push($excelsheet, $dayrecord);
            }
            $cRow = 7;
            $cCol = 0;
           
            foreach ($excelsheet as $key => $row) {
                $sheet->mergeCells('B3:L3');
                $sheet->setCellValue('B3', 'KPS - Zeiterfassung');
                $sheet->getStyle('B3:L3')->applyFromArray($styleheader);
                $sheet->getStyle('B4:L4')->applyFromArray($styleheaderdetails);
                $sheet->mergeCells('B4:C4');
                $sheet->setCellValue('B4', 'Name, Vorname: ');
                $sheet->mergeCells('D4:I4');
                $sheet->setCellValue('D4', $emp['first_name'] . ',' . $emp['last_name']);
                $sheet->setCellValue('J4', '  Monat / Jahr: ');
                $sheet->setCellValue('K4', $this->getgermonmonth());
                $sheet->setCellValue('L4', $this->year);
                $sheet->mergeCells('B6:C7');
                $sheet->mergeCells('D6:D7');
                $sheet->mergeCells('E6:E7');
                $sheet->mergeCells('F6:F7');
                $sheet->mergeCells('G6:G7');
                $sheet->mergeCells('H6:H7');
                $sheet->setCellValue('B6', 'Datum');
                $sheet->setCellValue('D6', 'Arbeits-beginn');
                $sheet->setCellValue('E6', 'Arbeits-ende');
                $sheet->setCellValue('F6', 'Stunden');
                $sheet->setCellValue('G6', 'Kennzeichen');
                $sheet->setCellValue('H6', 'Station');
                $sheet->mergeCells('B40:D40');
                $sheet->mergeCells('B41:D41');
                $sheet->mergeCells('B42:D42');
                $sheet->mergeCells('B43:D43');
                $sheet->mergeCells('E40:F40');
                $sheet->mergeCells('E41:F41');
                $sheet->mergeCells('E42:F42');
                $sheet->mergeCells('E43:F43');

                $sheet->setCellValue('B40', 'Summe der Arbeitsstunden TOTAL');
                $sheet->setCellValue('E40', '=SUM(F8:F36)');
                $sheet->setCellValue('B41', './. Sollstunden / Monat:');
                $sheet->setCellValue('B42', 'Plusstunden laufender Monat');
                $sheet->setCellValue('B43', 'Verschuldete Unfälle');
                $sheet->getStyle('B8:H36')->applyFromArray($styleheaderdetailsdata);
                $sheet->getStyle('B40:F43')->applyFromArray($styleheaderdetailsjob);
                $sheet->getStyle('B6:H7')->applyFromArray($styleheaderdetailsjob);
                $sheet->getStyle('B6:F6')->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('c9c9c9');
                $sheet->getStyle('H6')->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('ffe699');
                $sheet->getStyle('G6')->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('f4b084');
                $sheet->getStyle('K4')->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('ffff00');
                $cRow++; // NEXT ROW
                $cCol = 66; // RESET COLUMN "A"
                foreach ($row as $cell) {
                    $sheet->setCellValue(chr($cCol) . $cRow, $cell);
                    if ($row['0'] == "Montag" || $row['0'] == "Sonntag") {
                        $sheet->getStyle('C' . $cRow . ':F' . $cRow)->applyFromArray($styleheaderdetailsjob);
                        $sheet->getStyle('C' . $cRow . ':F' . $cRow)->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('bcd6ee');
                    }
                    if (isset($row['2'])) {

                        if (isset($row['4'])) {
                            if ($row['4'] < 8) {
                                $sheet->getStyle('F' . $cRow)->getFill()
                                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                                    ->getStartColor()->setARGB('8497b0');
                            } else {
                                $sheet->getStyle('F' . $cRow)->getFill()
                                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                                    ->getStartColor()->setARGB('8497b0');
                            }
                            $sheet->getStyle('C' . $cRow . ':H' . $cRow)->applyFromArray($styleheaderdetailsjob);
                            $sheet->getStyle('G' . $cRow)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                                ->getStartColor()->setARGB('fbe4d5');
                            $sheet->getStyle('H' . $cRow)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                                ->getStartColor()->setARGB('fff3cb');
                        }
                    }
                    $cCol++;
                }
            }
            $this->spreadsheet->createSheet();
        }
        $writer = new Xlsx($this->spreadsheet);
        $rootpath = WRITEPATH . '/uploads/excelreport';
        if (!is_dir($rootpath)) {
            mkdir($rootpath, 0777, TRUE);
        }
        $path = $rootpath . '/Zeiterfassung' . date('Y-m-d') . '.xlsx';
        $writer->save($path);
        return $path;
    }
    public function sendreport()
    {
        print_r($this->genratexcel());
        $this->email->setFrom("carma@gmail.com", 'Carma');
        $this->email->setTo('admin@yopmail.com');
        $this->email->setSubject('Carma | Damage Report');
        //$this->email->attach($this->genratexcel());
        if ($this->emailemail->send()) {
            return true;
        } else {
            return false;
        }
    }
    //--------------------------------------------------------------------
}
