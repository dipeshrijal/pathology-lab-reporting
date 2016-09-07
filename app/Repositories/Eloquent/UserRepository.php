<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\Repository;

class UserRepository extends Repository
{
    public function model()
    {
        return 'App\Entities\User';
    }

    public function fetch($q)
    {
        return $users =  $this->model
        ->where(function ($query) use ($q) {
            $query->where('name', 'LIKE', "%{$q}%")
            ->orWhere('email', 'LIKE', "%{$q}%")
            ->orWhere('phone', 'LIKE', "%{$q}%");
        })
        ->whereHas('roles', function ($query) {
            return $query->where('name', 'patient');
        })->paginate(8);
    }

    public function patients()
    {
        return $this->model->whereHas('roles', function ($q) {
            return $q->where('name', 'patient');
        })->paginate(8);
    }

    public function filterPatients($q)
    {
        $users =  $this->model->where('name', 'LIKE', "%{$q}%")->whereHas('roles', function ($q) {
            return $q->where('name', 'patient');
        })->paginate(20);

        $data          = [];
        $data['total'] = $users->total();
        $data['items'] = $users->transform(function ($item, $key) {
            return [
                'text' => $item->name,
                'id'   => $item->id,
            ];
        });

        return $data;
    }

    public function sendPasscode($user)
    {
        $passcode = str_random(6);
        $user->update(['password' => bcrypt($passcode)]);

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
        $mail->Subject = 'PassCode';
        $mail->msgHTML('Your Password is ' . $passcode);

        return $mail;
    }

}
