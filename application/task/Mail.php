<?php
/*
 * This file is part of the NB Framework package.
 *
 * Copyright (c) 2018 https://nb.cx All rights reserved.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace task;

use utils\PHPMailer;
/**
 *
 * User: Collin
 * QQ: 1169986
 * Date: 17/12/8 上午11:51
 */
class Mail {

    public function index() {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.qiye.163.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'lookmanhua_cs1@huoxiandaka.com';
        $mail->Password = 'Moyou_cs_66';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 25;
        $mail->CharSet='UTF-8';
        $mail->setFrom('lookmanhua_cs1@huoxiandaka.com', '火线大咖邮件测试');
        $mail->addAddress('1169986@qq.com');
        $mail->isHTML(true);
        $mail->Subject = 'hello test';
        $mail->Body  = '测试邮件，如有打扰，请忍耐！谢谢。';
        $mail->AltBody = 'LookManHua! 官方团队';
        if($mail->send()) {
            return '发送成功';
        }
        return '发送失败：'.$mail->ErrorInfo;
    }

}