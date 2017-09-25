<p>
Hello {{$name}}, 
</p>

<p>Please confirm stock added by {{$username}}: </p>
<table border="0">
<tr><td><strong>Item</strong> : </td><td>{{$itemname}}</td></tr>
<tr><td><strong>Location</strong> : </td><td>{{$location}}</td></tr>
<tr><td><strong>Quantity</strong> : </td><td>{{$quantity}}</td></tr>
</table>
<br>
<p>Click on the link below to confirm stock</p>

<p><a href="{{URL::to('confirmstock/'.$id.'/'.$itemname)}}">Confirm stock</a></p>
<br><br>
<p>Regards,</p>
<p>Gas Express</p>