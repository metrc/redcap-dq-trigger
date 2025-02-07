# Data Quality Rule Trigger for REDCap

---

This API extension is implemented as a REDCap external module and allows
you to progmatically trigger a data quality rule and run 'Fix Calcs' on
that rule.

---

## Sample Usage
~~~
    function executeRule($pid, $rule_id, $api_token)
    {
        $data = ['rule_id' => $rule_id, 'token' => $api_token];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'URL_TO_REDCAP/redcap/api/?prefix=dq_trigger&page=trigger&pid=' . $pid . '&type=module&NOAUTH');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data, '', '&'));
        curl_exec($ch);
        curl_close($ch);
    }
    
    executeRule('PROJECT_ID', 'RULE_ID', 'API_TOKEN', true); 
~~~

### Note on Rule ID
Built-in REDCap data quality rules can be executed by simply passing the letter of the
rule.  All other rules must be prefixed with "pd-" and the number of the rule, plus 9.
For example, to execute the calculations on user-defined rule 1, pass "pd-10" as the $rule_id.

## For Support
Source code can be found at https://github.com/metrc/redcap-dq-trigger.  Additional
suggestions, comments, and basic help can be obtained by emailing [psullivan@jhu.edu](mailto:psullivan@jhu.edu)  