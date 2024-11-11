<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static LICENCIA_MEDICA()
 * @method static static LICENCIA_MATERNA()
 * @method static static EXTRAS_50()
 * @method static static EXTRAS_100()
 * @method static static INJUSTIFICADO()
 */
final class TiposType extends Enum
{
    const LICENCIA_MEDICA = 1;
    const LICENCIA_MATERNA = 2;
    const EXTRAS_50 = 3;
    const EXTRAS_100 = 4;
    const INJUSTIFICADO = 5;
}
