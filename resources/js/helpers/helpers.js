export function displayNumber(paginationData, index) {
    if (!paginationData || !paginationData.current_page || !paginationData.per_page) {
        return '';
    }
    return (paginationData.current_page - 1) * paginationData.per_page + index + 1;
}