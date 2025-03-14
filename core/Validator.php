<?php 
class Validator {
    public static function validate($data, $rules) {
        $errors = [];
        foreach ($rules as $field => $ruleSet) {
            foreach ($ruleSet as $rule) {
                if ($rule === 'required' && empty($data[$field])) {
                    $errors[$field] = "$field es obligatorio.";
                } elseif ($rule === 'numeric' && !is_numeric($data[$field])) {
                    $errors[$field] = "$field debe ser un número.";
                } elseif ($rule === 'string' && !is_string($data[$field])) {
                    $errors[$field] = "$field debe ser una cadena de texto.";
                } elseif ($rule === 'float' && !filter_var($data[$field], FILTER_VALIDATE_FLOAT)) {
                    $errors[$field] = "$field debe ser un número decimal válido.";
                }
            }
        }
        return $errors;
    }
}
?>