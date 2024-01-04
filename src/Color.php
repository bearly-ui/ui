<?php

namespace Bearly\Ui;

enum Color: string
{
    use Comparable;

    case Primary = 'primary';
    case Secondary = 'secondary';
    case Success = 'success';
    case Warning = 'warning';
    case Error = 'error';
    case None = 'none';
}
