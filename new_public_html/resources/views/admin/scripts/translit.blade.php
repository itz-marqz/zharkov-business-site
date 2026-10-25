<?
    $translit_from = $translit[0];
    unset($translit[0]);
    $translit_to = '';
    $translit_length = count($translit);

    $pointer = 0;
    foreach($translit as $trans):
        if(++$pointer == $translit_length)
            $translit_to .= 'input[name="' . $trans . '"]';
        else
            $translit_to .= 'input[name="' . $trans . '"], ';
    endforeach;
?>
<script>
    url_touched = false;

    $('input[name="url"]').change(function() { url_touched = true; });
    $('input[name="name"]').keyup(function() {
        if(!url_touched)
            $('<?=$translit_to?>').val(generate_url());
    });

    function generate_url()
    {
        url = $('input[name="name"]').val();
        url = url.replace(/[\s]+/gi, '-');
        url = translit(url);
        url = url.replace(/[^0-9a-z_\-]+/gi, '').toLowerCase();
        return url;
    }

    function translit(str)
    {
        var ru=("А-а-Б-б-В-в-Ґ-ґ-Г-г-Д-д-Е-е-Ё-ё-Є-є-Ж-ж-З-з-И-и-І-і-Ї-ї-Й-й-К-к-Л-л-М-м-Н-н-О-о-П-п-Р-р-С-с-Т-т-У-у-Ф-ф-Х-х-Ц-ц-Ч-ч-Ш-ш-Щ-щ-Ъ-ъ-Ы-ы-Ь-ь-Э-э-Ю-ю-Я-я").split("-")
        var en=("A-a-B-b-V-v-G-g-G-g-D-d-E-e-E-e-E-e-ZH-zh-Z-z-I-i-I-i-I-i-J-j-K-k-L-l-M-m-N-n-O-o-P-p-R-r-S-s-T-t-U-u-F-f-H-h-TS-ts-CH-ch-SH-sh-SCH-sch-'-'-Y-y-'-'-E-e-YU-yu-YA-ya").split("-")
        var res = '';
        for(var i=0, l=str.length; i<l; i++)
        {
            var s = str.charAt(i), n = ru.indexOf(s);
            if(n >= 0) { res += en[n]; }
            else { res += s; }
        }
        return res;
    }
</script>