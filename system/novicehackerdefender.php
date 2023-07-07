<?
function cleanInput($data) {
    if (is_array($data)) {
        foreach ($data as $key => $value) {
            $data[$key] = cleanInput($value);
        }
    } else {
        $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    }
    return $data;
}
foreach($_POST as $key => $value) { $$key = cleanInput($value); }
foreach($_GET as $key => $value) {  $$key = cleanInput($value); }
?>