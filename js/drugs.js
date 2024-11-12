const filters = document.getElementsByClassName("filter");
const drugs = document.getElementsByClassName("drug");
let activeFilters = [];

console.log("connected");
console.log(filters);

for (let i = 0; i < filters.length; i++) {
  const filter = filters[i];
  filter.addEventListener("click", (e) => {
    const filterValue = e.target.dataset.filter;
    if (filterValue === "all") {
      activeFilters = [];
      updateUi();
      return;
    }

    if (activeFilters.includes(filterValue)) {
      activeFilters = activeFilters.filter((filter) => filter !== filterValue);
      updateUi();
    } else {
      activeFilters.push(filterValue);
      updateUi();
    }
  });
}

const updateUi = () => {
  console.log(activeFilters);
  if (activeFilters.length === 0) {
    console.log("all");
    Array.from(drugs).forEach((drug) => drug.classList.remove("hidden"));
    Array.from(filters).forEach((filter) => {
      if (filter.dataset.filter === "all") {
        filter.classList.add("active");
      } else {
        filter.classList.remove("active");
      }
    });
    return;
  }

  Array.from(filters).forEach((filter) => {
    if (activeFilters.includes(filter.dataset.filter)) {
      filter.classList.add("active");
    } else {
      filter.classList.remove("active");
    }
  });

  Array.from(drugs).forEach((drug) => {
    if (activeFilters.includes(drug.dataset.category)) {
      drug.classList.remove("hidden");
    } else {
      drug.classList.add("hidden");
    }
  });
};
