<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<script>
    let array = [1, 2, 3, 4, 5];
let newArray = array.slice(0, 5).concat(array.slice(4));
console.log(newArray); // Output: [1, 2, 4, 5]

</script>
</body>
</html>