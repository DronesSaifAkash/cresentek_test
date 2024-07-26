<div class="footer">
    <h2>Categories From Composer View</h2>
    <ul>
        @foreach ($categories as $category)
            <li>{{ $category->name }}</li>
        @endforeach
    </ul>
</div>
<style>
   .footer {
    
    bottom: 0;
    width: 100%;
    background-color: #f1f1f1;
    padding: 20px;
    text-align: center;
    box-shadow: 0 -2px 5px rgba(0,0,0,0.1);
    margin-top:100px;
}

.footer h2 {
    color: #333;
}

.footer ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
}

.footer ul li {
    display: inline;
    margin: 0 10px;
}

</style>