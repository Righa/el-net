
#API ROUTES
<table>
	<tr><td>POST</td><td>api/login</td><td></td></tr>
	<tr><td>POST</td><td>api/logout</td><td></td></tr>
	<tr><td>POST</td><td>api/register</td><td></td></tr>
	<tr><td>POST</td><td>api/profile</td><td></td></tr>
</table>

##apiResources items

<ul>
	<li>votes</li>
	<li>takes</li>
	<li>exams</li>
	<li>topics</li>
	<li>forums</li>
	<li>courses</li>
	<li>subjects</li>
	<li>material</li>
	<li>enrollment</li>
	<li>contributions</li>
</ul>

##Routes in apiResources;
<table>
	<tr><td>GET</td><td>api/item</td><td>all</td></tr>
	<tr><td>GET</td><td>api/item/{id}</td><td>one</td></tr>
	<tr><td>POST</td><td>api/item</td><td>add</td></tr>
	<tr><td>PUT</td><td>api/item/{id}</td><td>edit</td></tr>
	<tr><td>DELETE</td><td>api/item/{id}</td><td>delete</td></tr>
</table>

##Not in use;

<ul>
	<li>all,edit, in enrollment</li>
	<li>all, in exams</li>
	<li>all,one,edit,delete, in contributions</li>
	<li>all,one, in material</li>
	<li>all, in takes</li>
	<li>all,one, in topics</li>
	<li>all,one,edit,delete, in votes</li>
</ul>

##Special

<ul>
	<li>GET api/enrollment/id - takes course id</li>
</ul>
