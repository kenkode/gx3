<p>
Hello {{$name}}, 
</p>

<p>Please approve the following item updated by {{$username}}: </p>
<table border="0">
<tr><td><strong>Client</strong> : </td><td>{{$client->name}}</td></tr>
<tr><td><strong>Item</strong> : </td><td>{{$item->item_make}}</td></tr>
<tr><td><strong>Selling Price</strong> : </td><td>{{$item->selling_price}}</td></tr>
<tr><td><strong>Discount</strong> : </td><td>{{$discount}}</td></tr>
</table>
<br>
<p>Click on the link below to approve price update</p>

<p><a href="{{URL::to('approvepriceupdate/'.$client->id.'/'.$item->id.'/'.$discount.'/'.$receiver.'/'.$id)}}">Approve Item Update</a></p>
<br><br>
<p>Regards,</p>
<p>Gas Express</p>