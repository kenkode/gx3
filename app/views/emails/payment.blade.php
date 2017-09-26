<p>
Hello {{$name}}, 
</p>

<p>Please approve the following payment updated by {{$username}}: </p>
<table border="0">
<tr><td><strong>Client</strong> : </td><td>{{$client->name}}</td></tr>
<tr><td><strong>Amount</strong> : </td><td>{{$amount}}</td></tr>
</table>
<br>
<p>Click on the link below to approve amount update</p>

<p><a href="{{URL::to('approvepaymentupdate/'.$client->id.'/'.$amount.'/'.$paymentmethod.'/'.$account.'/'.$received_by.'/'.$payment_date.'/'.$receiver.'/'.$id)}}">Approve Payment</a></p>
<br><br>
<p>Regards,</p>
<p>Gas Express</p>