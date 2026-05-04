<html>
    <body>
        <form method="POST" action={{ route("import") }}>
                    @csrf
                    <input type="number" name="input_num"/>
                    <select name="type">
                        <option value="products">Products</option>
                        <option value="categories">Categories</option>
                    </select>
                    <input type="submit" name="submit"/>
                </form>
    </body>
    </html>