# Quick Test Checklist - Custom Interest Rate Feature

## Pre-Test Setup
- [ ] Clear browser cache (Ctrl+Shift+Delete)
- [ ] Close all browser tabs with housing calculator
- [ ] Open incognito/private window if possible (cleaner testing)
- [ ] Open DevTools (F12) and keep it visible

## Test Steps

### Test 1: Custom Rate HIGHER than Default
**Scenario**: User increases interest rate from 6.5% to 8%

**Steps**:
1. Go to `/en/loans/housing`
2. Select country: **UAE** (default rate: 6.5%)
3. Property Value: **500,000**
4. Down Payment: **20%**
5. Loan Term: **25 years**
6. Check ✓ **"Use Custom Interest Rate"**
7. Enter: **8** in custom rate field
8. Click **Calculate**

**Expected Console Output**:
```
🔍 Before submission:
  useCustomRate (checkbox): true
  customRateValue (input): 8
  customRateValue is empty? false
✅ Setting custom rate to: 8
✅ Verified custom_rate in FormData: 8
📤 Final custom_rate in FormData: 8
📤 Has custom_rate? true
```

**Expected UI Results**:
- Interest Rate: **8%** ✓ (NOT 6.5%)
- Monthly Payment: Should be HIGHER than 6.5% rate
- Total Payment: Should be HIGHER than 6.5% rate

**Pass/Fail**: ☐ PASS ☐ FAIL

---

### Test 2: Custom Rate LOWER than Default
**Scenario**: User decreases interest rate from 6.5% to 4%

**Steps**:
1. Select country: **UAE**
2. Property Value: **500,000**
3. Down Payment: **20%**
4. Loan Term: **25 years**
5. Check ✓ **"Use Custom Interest Rate"**
6. Enter: **4** in custom rate field
7. Click **Calculate**

**Expected UI Results**:
- Interest Rate: **4%** ✓ (NOT 6.5%)
- Monthly Payment: Should be LOWER than 6.5% rate
- Total Payment: Should be LOWER than 6.5% rate

**Pass/Fail**: ☐ PASS ☐ FAIL

---

### Test 3: Uncheck Box - Should Use Default
**Scenario**: User unchecks the custom rate box

**Steps**:
1. Select country: **UAE**
2. Enter all other fields
3. Check ✓ **"Use Custom Interest Rate"**
4. Enter: **7** in custom rate field
5. **UNCHECK** the "Use Custom Interest Rate" box (remove ✓)
6. Click **Calculate**

**Expected Console Output**:
```
🔍 Before submission:
  useCustomRate (checkbox): false
  ...
❌ Checkbox not checked - using default rate
📤 Has custom_rate? false
```

**Expected UI Results**:
- Interest Rate: **6.5%** ✓ (Default, not 7)

**Pass/Fail**: ☐ PASS ☐ FAIL

---

### Test 4: Check Box but Leave Empty - Should Use Default
**Scenario**: User checks box but doesn't enter a value

**Steps**:
1. Select country: **UAE**
2. Enter all other fields
3. Check ✓ **"Use Custom Interest Rate"**
4. Leave custom rate field **EMPTY** (don't enter anything)
5. Click **Calculate**

**Expected Console Output**:
```
🔍 Before submission:
  useCustomRate (checkbox): true
  customRateValue (input): ""
  customRateValue is empty? true
⚠️ Checkbox checked but input empty - using default
📤 Has custom_rate? false
```

**Expected UI Results**:
- Interest Rate: **6.5%** ✓ (Default)

**Pass/Fail**: ☐ PASS ☐ FAIL

---

### Test 5: Change Rate and Recalculate
**Scenario**: User changes the custom rate and auto-recalculates

**Steps**:
1. Select country: **UAE**
2. Enter all other fields
3. Check ✓ **"Use Custom Interest Rate"**
4. Enter: **6** in custom rate field
5. Click **Calculate** → See results with 6%
6. **Change** custom rate to: **9**
7. Blur the input (click elsewhere) to trigger auto-calculate

**Expected**:
- Results should automatically update to show 9% rate
- Monthly payment should recalculate (higher with 9%)

**Pass/Fail**: ☐ PASS ☐ FAIL

---

## Summary Table

| Test | Scenario | Expected Rate | Pass? |
|------|----------|---|---|
| 1 | Custom 8% | 8% | ☐ |
| 2 | Custom 4% | 4% | ☐ |
| 3 | Unchecked | 6.5% | ☐ |
| 4 | Checked but empty | 6.5% | ☐ |
| 5 | Change and recalc | 9% | ☐ |

## If Any Test Fails

### Immediate Actions:
1. **Take a screenshot** of:
   - Console output (all logs)
   - Network tab showing the POST request
   - UI showing the interest rate

2. **Note what happened**:
   - What interest rate was shown?
   - What did the console show?
   - Was custom_rate in FormData?

3. **Check Laravel logs**:
   ```bash
   tail -20 storage/logs/laravel.log
   ```
   Look for "Housing Loan Calculation" entry

4. **Report with**:
   - Test number that failed
   - Expected vs actual result
   - Screenshots of console and UI
   - Console logs (copy/paste)

## Network Tab Verification

For any test, you can also check the Network tab:

1. Open DevTools → Network tab
2. Click Calculate
3. Find POST request to `loan.housing.calculate`
4. Click on it
5. Go to "Request" or "Payload" tab
6. Look for: `custom_rate: 8` (or whatever you entered)
7. Take screenshot if custom_rate is missing

## Success Criteria

✅ **FEATURE IS WORKING** when:
- [ ] All 5 tests pass
- [ ] Interest rate matches what user entered
- [ ] Monthly payment changes proportionally
- [ ] Console shows custom_rate in FormData
- [ ] Unchecking/emptying field falls back to default

❌ **FEATURE IS NOT WORKING** if:
- Interest rate always shows default (6.5%)
- Custom rate not in console logs
- Custom rate not in Network payload
- Monthly payment doesn't change with custom rate

## Notes
- Make sure to do each test in sequence
- Clear cache if behavior changes mid-session
- Use same country for consistent default rate comparison
- Check console DURING the calculation (don't scroll past it)
