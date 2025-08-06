SELECT 
    outputs.*,
    requests.*,
    users.*,
    products.*
FROM outputs
INNER JOIN requests ON outputs.id_requisicao = requests.id
INNER JOIN users ON outputs.autorizado_por = users.id
INNER JOIN request_products ON request_products.id_requisicao = requests.id
INNER JOIN products ON request_products.id_produto = products.id
WHERE outputs.data BETWEEN 'YYYY-MM-DD HH:MM:SS' AND 'YYYY-MM-DD HH:MM:SS';
