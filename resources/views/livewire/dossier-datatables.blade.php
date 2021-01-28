<x-layout>
  <div class="md:flex">
      <div class="md:justify-center w-full">
            <br>
            <br>  
          
          <div>
                <h2 class="text-black text-4xl leading-10">Search Dossier</h2>
          </div>
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