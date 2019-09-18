<?php


namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class CalcController
{
    
    public function index(){

        $html = '<table border="1" cellpadding="15" cellspacing="0"><tr>
				<td>Дата</td>
				<td>Процент по кредиту</td>
				<td>Общий платеж по кредиту</td>
				<td>+ к платежу</td>
				<td>Остаток по кредиту</td>
				<td></td>
				<td>Если собирать за тот же период</td>
				<td>Накоплено</td>
			</tr>';

        $credit = 4500000; // стоимость квартиры
        $date = time() /* + 31536000 + 18144000*/;

        $nakopleno = 1215000; // берем кредит только когда собиру определенную сумму.

        // 260 вычет базовый
        // 390 вычет по процентам

        //$in = 1;
        $month = 180; // 180 - 15 лет
        $credit_tmp = $credit;
        $i = 10/12/100;
        $plus_platej = 0;//50000; // дополнительно к каждому платежу
        $proc = false;
        $pl = '';
        $kv = 25000;
        // каждый год премия, если будет
        $premija = 0;
        $count_years = 0;
        $proc_sum = 0;
        $vichet = 0;
        $platej2 = true;

        $summa = 0;
        $kv_perepl = 0;

        while($credit > 0)
        {
            // считаем даты
            $cur_ = date('m.Y', $date);
            $m = date('n', $date);
            $Y = date('Y', $date);
            $date = mktime(0,0,0,++$m,1,$Y);

            $new_y = false;
            if($m == 13)
            {
                $new_y = true;
            }

            // пока копим деньги до 1 000 000
            if($nakopleno < 900000 && $nakopleno !== 0)
            {
                //после июля 2020 буду откладывать по 70 000
                if($date > mktime(0,0,0,13,1,2019))
//                if($date > mktime(0,0,0,7,1,2020))
                {
                    $nakopleno += 90000;
                }
                else
                {
                    $nakopleno += 60000;
                }

                if($m == 13)
                {
                    // премия
                    $nakopleno += $premija;
                }
            }
            else{ // тут началась ипотека

                if($nakopleno > 0)
                {
                    $credit = $credit - $nakopleno;
                    $credit_tmp = $credit;

                    if($summa == 0)
                    {
                        $summa = $nakopleno;
                    }
                    $nakopleno = 0;
                }

                $k = ($i * pow((1 + $i), $month)) / (pow((1 + $i), $month) - 1);
                $pl =  $k * $credit_tmp;


                // какая часть платежа является процентом?
                $proc = ($credit*10/100/12);
                $proc_sum += $proc;

                if($platej2){
                    $pl_tmp = $pl / 2;
                    $credit -= ($pl_tmp - $proc);
                } else {
                    $credit -= ($pl - $proc);
                }
                // платеж минус процентная часть получается сумма которая идет в погашение основного долга
                $credit -= ($pl - $proc);
                $credit -= $plus_platej;
                $credit -= $vichet;

                if($m == 13)
                {
                    $count_years++;
                    if($count_years == 2)
                    {
                        $vichet = 260000;
                    }
                    elseif($count_years == 3)
                    {
                        $vichet = 390000;
                    }
                    elseif($count_years == 4)
                    {
                        //$vichet = 240000;
                    }
                    elseif($count_years == 5)
                    {
                        //$vichet = 150000;
                    }

                    // премия
                    $vichet += $premija;
                }
                else
                {
                    $vichet = 0;
                }

                //Расчет если не брать кредит
                $otklad = 15000;
                $summa += $otklad + $plus_platej;
                $summa += ($summa * 0.06) / 12; // процент по вкладу
                $kv_perepl += $kv;
            }

            $html .= '<tr'.($proc !== false && $proc <= $kv ? ' style="background-color:green;" ' : '').'>
						<td>'.$cur_.'</td>
						<td>'.round($proc, 2).' %</td>
						<td>'.round($pl, 2).' руб</td>
						<td>'.$plus_platej.' '.$vichet.'</td>
						<td>'.number_format($credit, 2, ',', ' ').'</td>
						<td> </td>
						<td>'.number_format(round($summa, 0), 0, ',', ' ').'</td>

						<td>'.$nakopleno.'</td>
					</tr>';

            if($new_y)
            {
                $html .= '<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>';
            }
        }

        $html .= '</table>';
//        echo $html;
//        echo 'Сумма переплаты: '.$proc_sum;
//        echo ' kv: '.$kv_perepl;
//
//        echo '! ! !';

        return new Response($html);
    }

}