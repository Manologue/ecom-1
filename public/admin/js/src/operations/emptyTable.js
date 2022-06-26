const emptyTable = async (container, table) => {
  const emptyContainer = container.querySelector('.empty-container')

  const tableName = table.getAttribute('tab')
  const tableBody = container.querySelector('tbody')
  // show empty container if no items left (not working for categories)
  if (emptyContainer) {
    if (tableBody.children.length === 0) {
      emptyContainer.style.display = 'grid'

      emptyContainer.innerHTML = `<h1>No ${tableName} found</h1>`
    }
  }

  // working for all tables

  if (table) {
    if (tableBody.children.length === 0) {
      table.innerHTML = `<h1>No ${tableName} found</h1>`
    }
  }
}

export default emptyTable
