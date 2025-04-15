<?php

namespace App;

enum PhoneLength
{
    const MEXICO = 10;

    const MEXICO_MASK = '9999999999';

    const GUATEMALA = 8;

    const GUATEMALA_MASK = '99999999';

    const EL_SALVADOR = 8;

    const EL_SALVADOR_MASK = '99999999';

    const PNC = 8;

    const PNC_MASK = '99999999';

    const HONDURAS = 8;

    const HONDURAS_MASK = '99999999';

    const COSTA_RICA = 8;

    const COSTA_RICA_MASK = '99999999';

    const PANAMA = 8;

    const PANAMA_MASK = '99999999';

    const COLOMBIA = 10;

    const COLOMBIA_MASK = '9999999999';
}
