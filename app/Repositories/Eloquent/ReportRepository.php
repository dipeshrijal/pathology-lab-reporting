<?php

namespace App\Repositories\Eloquent;

class ReportRepository extends Repository
{
    public function model()
    {
        return \App\Entities\Report::class;
    }

    public function fetch($q)
    {
        return $this->search($this->model, $q);
    }

    public function fetchPatientReport($q)
    {
        return $this->search(auth()->user()->reports(), $q);
    }

    public function search($model, $q)
    {
        return $model->with('patient')
        ->paginate(8);
    }

    public function email($report, $user)
    {
        $pdf = app('dompdf.wrapper');
        $pdf = $pdf->loadView('pdf.report', compact('report'));
        $file = $user->name . $report->id . str_random(5) . '.pdf';
        $fileLocation  = 'downloads/reports/' . $file;
        $pdf->save($fileLocation);

        $mail = new \PHPMailer(true);

        $mail->isSMTP();
        $mail->SMTPDebug = false;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = "xyzpathologylab@gmail.com";
        $mail->Password = "crossover!@#123";
        $mail->setFrom('operator@example.com', 'XYZ Lab');
        $mail->addAddress($user->email, $user->name);
        $mail->Subject = 'Report';
        $mail->msgHTML('Your Report has been sent');
        $mail->addAttachment($fileLocation);

        return compact('mail', 'fileLocation');
    }

    public function deletePDF($fileLocation)
    {
        if (file_exists($fileLocation)) {
            unlink($fileLocation);
        }
    }
}
