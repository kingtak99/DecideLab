# Custom Interest Rate Debug Guide

## Issue
Custom interest rate values are not being used in calculations. When a user:
1. Checks "Use Custom Interest Rate"
2. Enters a custom rate (e.g., 7)
3. Clicks Calculate

The calculation still uses the default country rate instead of the custom rate.

## Debug Steps

### Step 1: Open Browser Console
1. Go to Housing Simulation calculator
2. Press **F12** to open Developer Tools
3. Click the **Console** tab
4. Keep console visible during next steps

### Step 2: Test Custom Rate
1. Select a country (e.g., UAE)
2. Check "Use Custom Interest Rate" ✓
3. Enter a custom rate in the input (e.g., **7**)
4. Click **Calculate**

### Step 3: Check Console Output
Look for these log messages:

#### Should See These:
```
🔍 Before submission:
  useCustomRate (checkbox): true
  customRateValue (input): "7"
  customRateValue is empty? false
✅ Setting custom rate to: 7
📤 Form data being sent:
  country_id: "xxx"
  property_value: "xxx"
  custom_rate: "7"
  ...other fields...
```

#### Then After Response:
```
📊 Displaying results with interest rate: 7
📊 Custom checkbox checked: true
📊 Custom input value: 7
```

### Step 4: Verify Results
- Interest Rate should show: **7%** (not the default 6.5%)
- Monthly Payment and Total Payment should recalculate based on 7%

## Common Issues

### Issue 1: Console shows `useCustomRate: false`
- **Problem:** Checkbox is not checked when form submits
- **Fix:** Make sure checkbox is actually checked (has checkmark ✓)

### Issue 2: Console shows `customRateValue: ""`
- **Problem:** Input is empty when form submits
- **Fix:** Make sure you typed a value in the custom rate input before clicking Calculate

### Issue 3: Console shows `custom_rate: "7"` but results still show default
- **Problem:** Backend might not be receiving the value correctly
- **Solution:** Check browser Network tab:
  - Right-click the Calculate request in Network tab
  - Look at Request Payload for custom_rate value
  - If missing, it's a frontend issue
  - If present but ignored, it's a backend issue

### Issue 4: Interest Rate shows custom value but calculations are wrong
- **Problem:** Custom rate is being used but the calculation logic has an issue
- **Solution:** Check that the monthly payment changes proportionally
  - Higher rate = Higher monthly payment
  - Lower rate = Lower monthly payment

## Backend Logging
The controller now logs the custom rate handling:
- Check storage/logs/laravel.log
- Look for "Housing Loan Calculation" entries
- Should show:
  ```
  'custom_rate_input' => "7"
  'has_custom_rate' => true
  'default_rate' => 6.5
  'final_interest_rate' => 7
  ```

## Expected Behavior

### When Checkbox is CHECKED and Value is ENTERED:
- ✓ Custom rate used in calculation
- ✓ Interest Rate displays custom value
- ✓ Monthly Payment recalculates with custom rate

### When Checkbox is CHECKED but Value is EMPTY:
- ✓ Default rate used (custom_rate not sent)
- ✓ Interest Rate displays default value

### When Checkbox is UNCHECKED:
- ✓ Default rate used (custom_rate not sent)
- ✓ Interest Rate displays default value
- ✓ Input value is cleared

## Next Steps if Issue Persists

1. **Take a screenshot of console output** showing:
   - The FormData being sent
   - The response data
   - The final displayed results

2. **Check the Form Data in Network Tab:**
   - Open DevTools → Network tab
   - Click Calculate
   - Find the POST request to `loan.housing.calculate`
   - Click on it, go to "Request" or "Payload" tab
   - Screenshot the custom_rate value shown there

3. **Report with evidence:**
   - Console log showing FormData
   - Network tab showing request payload
   - Interest rate value displayed in UI
   - What you expected vs what you got

## PHP Log Check
Run this in terminal to see backend logs:
```bash
tail -f storage/logs/laravel.log | grep "Housing Loan"
```

Look for the custom_rate_input value being logged.
