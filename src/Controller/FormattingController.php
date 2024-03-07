<?

namespace JoyApplicant\Controller;

class FormattingController
{

    public function getValueFromArray($key, $ref)
    {
        // Check if the key exists in the array
        if (array_key_exists($key, $ref)) {
            return $ref[$key];
        } else {
            // Return a default message if the key is not found
            return "Key not found.";
        }
    }
}
