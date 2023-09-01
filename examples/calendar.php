<?php
function makeCalendarByMonth(int $year, int $month)
{
    //получаем номер дня недели для 1 числа месяца
    $timestamp = mktime(0, 0, 0, $month, 1, $year);
    $wday = date('N', $timestamp);

    //начинаем с этого числа в месяце
    // если меньше 0 или больше длины месяца, тогда в календаре будет пропуск.
    $n = -($wday - 2);
    $calendar = [];

    for ($y = 0; $y < 6; $y++) {
        $row = [];
        $notEmpty = false;
        //цикл внутри строки по дням недели.
        for ($x = 0; $x < 7; $x++, $n++) {
            //текущее число >0  и < длины месяца?
            if (checkdate($month, $n, $year)) {
                //Да. заполняем анкету
                $row[] = $n;
                $notEmpty = true;
            } else {
                //клетка пуст.
                $row[] = '';
            }
        }

        // если в данной строке ни одного непустого элемента,
        // значит месяц кончился.
        if ($notEmpty) {
            //добавляем строку в массив
            $calendar[] = $row;
        }
    }
    return $calendar;
}

function makeCalendarByYear(int $year)
{
    $months = [];
    for ($m = 1; $m < 13; $m++) {
        $months[] = makeCalendarByMonth($year, $m);
    }

    return $months;
}

$monthsNames = [
    'Январь',
    'Фервраль',
    'Март',
    'Апрель',
    'Май',
    'Июнь',
    'Июль',
    'Август',
    'Сентябрь',
    'Октябрь',
    'Ноябрь',
    'Декабрь',
];

$year = 2023;
$months = makeCalendarByYear($year);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Website</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="icon" href="./favicon.ico" type="image/x-icon">
</head>
<body>
<main>
    <h1>Welcome to Calendar by year <?php echo $year ?></h1>

    <?php foreach ($months as $key => $month) { ?>
        <h3><?php echo $monthsNames[$key] ?></h3>
        <table>
            <tr>
                <td>ПН</td>
                <td>ВТ</td>
                <td>СР</td>
                <td>ЧТ</td>
                <td>ПТ</td>
                <td>СБ</td>
                <td>ВС</td>
            </tr>
            <?php foreach ($month as $row) { ?>
                <tr>
                    <?php foreach ($row as $i => $v) { ?>

                        <td style="<?= $i === 6 ? 'color:red' : '' ?>">
                            <?php $v ? $v : "&nbsp;";
                            echo $v ?>
                        </td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </table>
    <?php } ?>
</main>
</body>
</html>
