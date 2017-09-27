<p>
Hello {{$name}}, 
</p>

<p>Please approve the following item updated by {{$username}}: </p>
<table border="0">
<tr><td><strong>Item Make</strong> : </td><td>{{$itemname}}</td></tr>
<tr><td><strong>Item Size</strong> : </td><td>{{$size}}</td></tr>
<tr><td><strong>Description</strong> : </td><td>{{$description}}</td></tr>
<tr><td><strong>Purchase Price</strong> : </td><td>{{$pprice}}</td></tr>
<tr><td><strong>Selling Price</strong> : </td><td>{{$sprice}}</td></tr>
<tr><td><strong>SKU</strong> : </td><td>{{$sku}}</td></tr>
<tr><td><strong>Tag Id</strong> : </td><td>{{$tagid}}</td></tr>
<tr><td><strong>Reorder Level</strong> : </td><td>{{$reorderlevel}}</td></tr>
</table>
<br>
<p>Click on the link below to approve item update</p>

<p><a href="{{URL::to('approveitemupdate/'.$itemname.'/'.$size.'/'.$description.'/'.$pprice.'/'.$sprice.'/'.$sku.'/'.$tagid.'/'.$reorderlevel.'/'.$receiver.'/'.$id)}}">Approve Item Update</a></p>
<br><br>
<p>Regards,</p>
<p>Gas Express</p>