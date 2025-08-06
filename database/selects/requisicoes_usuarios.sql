SELECT 
    r.*,
    u.nome AS requisitante,
    u.departamento,
    COUNT(rp.id) AS totalProdutos
FROM requests r
INNER JOIN users u ON r.id_funcionario = u.id
LEFT JOIN request_products rp ON rp.id_requisicao = r.id
WHERE r.id_funcionario = 'ID_DO_FUNCIONARIO'
  AND r.data BETWEEN 'YYYY-MM-DD 00:00:00' AND 'YYYY-MM-DD 23:59:59'
GROUP BY r.id;
