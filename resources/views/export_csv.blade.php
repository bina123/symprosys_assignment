<html>
    <body>
        <form method="POST" action={{ route("export_csv") }}>
                    @csrf
                    <select name="type">
                        <option value="categories">Categories</option>
                        <option value="products">Products</option>
                    </select>
                    <input type="submit" name="export" value="Export CSV"/>
                </form>
    </body>
    </html>