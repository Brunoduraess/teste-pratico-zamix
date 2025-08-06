SELECT 
    inputs.*,
    products.*,
    users.*
FROM inputs
INNER JOIN products ON inputs.id_produto = products.id
INNER JOIN users ON inputs.id_funcionario = users.id
WHERE inputs.data BETWEEN 'YYYY-MM-DD HH:MM:SS' AND 'YYYY-MM-DD HH:MM:SS';
