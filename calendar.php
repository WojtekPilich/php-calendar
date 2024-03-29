<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Calendar</title>
</head>
    <?php
    $startDate = new DateTime('now');
    if (isset($_POST['minus'])) {
        $startDate = $startDate->modify('-1 month');
    } elseif (isset($_POST['plus'])) {
        $startDate = $startDate->modify('+1 month');
    }
    $endDate = clone $startDate;
    $currentMonth = $startDate->format('F');
    $currentYear = $startDate->format('Y');

    $weeklyInterval = new DateInterval('P1W');
    $dailyInterval = new DateInterval('P1D');

    $mondays = clone $startDate
        ->modify('first day of this month')
        ->modify('Monday this week');
    $sundays = clone $endDate
        ->modify('last day of this month')
        ->modify('Sunday this week');
    $weekPeriods = new DatePeriod($mondays, $weeklyInterval, $sundays);
    ?>
<body class="bg-secondary">
    <div class="container">
        <div class="col-md-6 mx-auto text-center center-block">
            <br><br><br><br>
            <h1 class="text-warning"><?php echo $currentMonth . ' ' . $currentYear ?></h1><br>
            <table class="table table-striped table-fixed table-dark table-bordered">
                <thead class="bg-info">
                <tr>
                    <th scope="col">MON</th>
                    <th scope="col">TUE</th>
                    <th scope="col">WED</th>
                    <th scope="col">THU</th>
                    <th scope="col">FRI</th>
                    <th scope="col">SAT</th>
                    <th scope="col">SUN</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach ($weekPeriods as $firstMondayOfWeek): ?>
                        <tr>
                            <?php $days = new DatePeriod($firstMondayOfWeek, $dailyInterval, 6 ); ?>
                            <?php foreach ($days as $day): ?>
                                <td <?= $day->format('F') !== $currentMonth ? "class='bg-secondary'" : ''?>>
                                    <?= $day->format('d'); ?>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <br>
            <form action="" method="post">
                <div class="form-check-inline">
                    <label class="form-check-label" for="check1">
                        <button type="checkbox" class="btn btn-warning btn-sm" id="minus" name="minus" value="-1 month">-1 month</button>
                    </label>
                </div>
                <div class="form-check-inline">
                    <button type="submit" class="btn btn-info">Current Month</button>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label" for="check2">
                        <button type="checkbox" class="btn btn-warning btn-sm" id="plus" name="plus" value="+1 month">+1 month</button>
                    </label>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
