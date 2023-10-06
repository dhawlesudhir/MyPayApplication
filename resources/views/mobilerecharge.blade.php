<!DOCTYPE html>
<html>
<style>
  input[type=text],
  select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
  }

  input[type=submit] {
    width: 100%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }

  input[type=submit]:hover {
    background-color: #45a049;
  }

  div {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
  }
</style>

<body>

  <h3>Enter details for Mobile Recharge</h3>

  <div>

    <label for="mobile">Mobile Number</label>
    <input type="text" id="mobile" name="firstname" placeholder="mobile.." required>

    <label for="amt">Amount</label>
    <input type="text" id="amt" name="lastname" placeholder="amount.." required>

    <label for="operator">Operator</label>
    <select id="operator" name="country">
      <option value="jio">JIO</option>
      <option value="airtel">AIRTEL</option>
      <option value="idea">IDEA</option>
    </select>

    <input type="submit" value="Submit" onclick="submit()">

  </div>


  <script>
    function submit() {
      let mobileNumber = document.getElementById('mobile').value;
      let amount = document.getElementById('amt').value;
      let operator = document.getElementById('operator').value;

      console.log(mobileNumber, amount, operator);

      var myHeaders = new Headers();
      myHeaders.append("Cookie", "token=2|V1JzIEFdN0GqIO82Ndj6dfCIK43Ws1uumbAwL9fa");

      var formdata = new FormData();
      formdata.append("mobile", mobileNumber);
      formdata.append("operator", operator);
      formdata.append("amount", amount);
      formdata.append("details", "NA");

      var requestOptions = {
        method: 'POST',
        headers: myHeaders,
        body: formdata,
        redirect: 'follow'
      };

      fetch("http://127.0.0.1:8001/api/mobilerechargecall", requestOptions)
        .then(response => response.json())
        .then(result => {
          if (result[0] == 'success') {
            alert('Recharge successful, reference id ' + result[1]);
          } else if (result[0] == 'pending') {
            alert('Recharge is pending, please wait, reference id ' + result[1]);
          } else if (result[0] == 'failed') {
            alert('Recharge is failed!');
          }
        })
        .catch(error => console.log('error', error));

    }
  </script>
</body>

</html>