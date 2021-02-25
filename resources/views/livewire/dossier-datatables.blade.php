<x-layout
:title="$title">
  <div class="md:flex">
      <div class="md:justify-center w-full">
            <br>
            <br>  
            <br>
            <br>
    
          <div class="w-full">    
            <livewire:dossier-datatables 
                  searchable="project_ref_id, company"
                   exportable
            />
  
          </div>
      </div>
        
  </div>
    
</x-layout>