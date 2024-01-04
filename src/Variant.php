<?php

namespace Bearly\Ui;

enum Variant: string
{
    use Comparable;

    case Ghost = 'ghost';
    case Glow = 'glow';
    case Gradient = 'gradient';
    case Link = 'link';
    case Outline = 'outline';
    case Solid = 'solid';
}
