<?php
	
	namespace App\Http\Controllers\Departaments;
	
	use App\Entities\Departaments\Departament;
	use App\Entities\Departaments\ExpenseAccount;
	use App\Entities\Departaments\IncomeAccount;
    use App\Entities\Departaments\ListDepartament;
    use App\Http\Controllers\Controller;
	use App\Http\Requests\DepartamentCreateRequest;
	use App\Repositories\Church\Departaments\ListDepartamentRepository;
	use App\Repositories\DepartamentRepository;
	use App\Traits\DataViewerTraits;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Crypt;
	use Illuminate\Support\Facades\DB;
	use Illuminate\Support\Facades\Validator;
	
	class DepartamentController extends Controller
	{
		
		use DataViewerTraits;
		
		/**
		 * @var ListDepartamentRepository
		 */
		private $listDepartamentRepository;
		/**
		 * @var DepartamentRepository
		 */
		private $departamentRepository;
		
		
		/**
		 * DepartamentController constructor.
		 *
		 * @param ListDepartamentRepository $listDepartamentRepository
		 * @param DepartamentRepository $departamentRepository
		 */
		public function __construct(ListDepartamentRepository $listDepartamentRepository, DepartamentRepository $departamentRepository)
		{
			$this->listDepartamentRepository = $listDepartamentRepository;
			$this->departamentRepository = $departamentRepository;
		}
		
		
		public function index()
		{
			
			return view('departament.listsDepartaments');
		}
		
		
		/**
		 * ---------------------------------------------------------------------
		 * @Author     : Anwar Sarmiento "asarmiento@sistemasamigables.com"
		 * @Date       Create: 2017-08-27
		 * @Time       Create: 5:38pm
		 * @Date       Update: 0000-00-00
		 * ---------------------------------------------------------------------
		 * @Description: Mostramos la vista para asignarle un departamento a la
		 *             iglesias
		 * @Pasos      :
		 * ----------------------------------------------------------------------
		 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
		 * ----------------------------------------------------------------------
		 */
		public function create()
		{
			$verify = $this->departamentRepository->balanceBudget();
			$block = false;
			if ($verify == 100.00)
			{
				$block = true;
			}
			
			return view('departament.create', compact('block'));
		}
		
		
		public function getData(Request $request)
		{
			$perPage = 10;
			if ($request->has('perPage'))
			{
				$perPage = $request->perPage;
			}
			
			$model = Departament::searchPaginateAndOrder($perPage, $request->get('search'),
			                                             true)->with('listDepartament')->where('status', 'activo')
                ->where('church_id', userChurch()->id)->paginate($perPage);
			
			$array = $this->myPages($model);
			
			$columns = Departament::$columns;
			
			$response = [
				'model'    => $model,
				'columns'  => $columns,
				'my_pages' => $array
			];
			
			return $response;
		}
		
		
		/**
		 * -----------------------------------------------------------------------
		 * @Author     : Anwar Sarmiento <asarmiento@sistemasamigables.com>
		 * @DateCreate : 2017-08-30
		 * @TimeCreate : 11:59am
		 * @DateUpdate : 0000-00-00
		 * -----------------------------------------------------------------------
		 * @description:
		 * @pasos      :
		 * ----------------------------------------------------------------------
		 * @param Request $request
		 * @var        ${TYPE_NAME}
		 * ----------------------------------------------------------------------
		 * @return array
		 * ----------------------------------------------------------------------
		 *
		 */
		public function inactiveDep(Request $request)
		{
			$perPage = 20;
			if ($request->has('perPage'))
			{
				$perPage = $request->perPage;
			}
			
			$model = Departament::searchPaginateAndOrder($perPage, $request->get('search'),
			                                             true)->with('incomeAccounts')->with('listDepartament')->where('status', 'inactivo')->paginate($perPage);
			$count = Departament::where('status', 'inactivo')->where('church_id',
			                                                         1)->sum('percent_of_budget');
			$array = $this->myPages($model);
			
			$columns = Departament::$columns;
			
			$response = [
				'model'    => $model,
				'columns'  => $columns,
				'my_pages' => $array,
				'count'    => $count
			];
			
			return $response;
		}
		
		
		/**
		 * ---------------------------------------------------------------------
		 * @Author     : Anwar Sarmiento "asarmiento@sistemasamigables.com"
		 * @Date       Create: 2017-08-27
		 * @Time       Create: 5:13pm
		 * @Date       Update: 2017-09-05
		 * ---------------------------------------------------------------------
		 * @Description: Aqui relacionamos un departamento con una iglesia
		 *             y le ponemos el presupuesto que esta asignado.
		 * @Pasos      :
		 * 1.   verificamos si el departamentos existe
		 * 2.   cargamos las variables faltantes
		 * 3.   creamos la cuenta de ingreso de base que se usara  para la
		 *      distribucion del 60% de ofrenda si tubiera presupuesto.
		 * @param DepartamentCreateRequest $request
		 * ----------------------------------------------------------------------
		 * @return \Illuminate\Http\JsonResponse
		 * ----------------------------------------------------------------------
		 */
		public function store(DepartamentCreateRequest $request)
		{
			try
			{
				DB::beginTransaction();
				$data = $request->all();
				$newDepartamen = $this->listDepartamentRepository->token($data['name']['value']);
				if (Departament::where('list_departament_id', $newDepartamen->id)->where('church_id',userChurch()->id)->count() > 0):
					return response()->json(['errors' => ['El Departamento: ' . $newDepartamen->name . ' ya Existe']], 422);
				endif;
				$data['church_id'] =  userChurch()->id;
				$data['budget'] = 0;
				$data['initial'] = $data['balance'];
				$data['status'] = 'desactivo';
				$data['authorized'] = 'no';
				$data['list_departament_id'] = $newDepartamen->id;
				$data['token'] = Crypt::encrypt($newDepartamen->name);
				
				$departament = new Departament();
				$departament->fill($data);
				if ($departament->save())
				{
					$data['name'] = 'Ing-base-' . $departament->listDepartament->name;
					$data['type'] = 'fix';
					$data['balance'] = 0;
					$data['departament_id'] = $departament->id;
					$incomeAccount = new IncomeAccount();
					$incomeAccount->fill($data);
					if ($incomeAccount->save()):
						$data['name'] = 'Gto-base-' . $departament->listDepartament->name;
						$data['income_account_id'] = $incomeAccount->id;
						$expenseAccount = new ExpenseAccount();
						$expenseAccount->fill($data);
						if ($expenseAccount->save())
						{
							DB::commit();
							
							return response()->json([
								                        'message' => 'El Departamento: ' . $newDepartamen->name . ' se registro con Exito',
								                        'count'   => Departament::where('status', 'inactivo')->where('church_id',
								                                                                                     1)->sum('percent_of_budget'),
								                        'dep'     => Departament::searchPaginateAndOrder(10, $request->get('search'),
								                                                                         true)->with('incomeAccounts')->with('listDepartament')->where('status', 'inactivo')->paginate(10)
							                        ], 200);
						} else
						{
							DB::rollback();
							
							return response()->json(['success' => false, 'message' => 'Genero un error'], 422);
						}
					else:
						DB::rollback();
						
						return response()->json(['success' => false, 'message' => 'Genero un error'], 422);
					endif;
				}
				DB::rollback();
				
				return response()->json(['errors' => ['El Departamento: ' . $newDepartamen->name . ' no se pudo registrar']],
				                        422);
			} catch (Exception $e)
			{
				DB::rollback();
				\Log::info(__FILE__ . ' ' . __FUNCTION__ . ' ' . __LINE__ . ' errors: ' . $e->getMessage() . ' line: ' . $e->getLine());
				abort($e->getCode());
			}
		}
		
		
		/**
		 * ---------------------------------------------------------------------
		 * @Author     : Anwar Sarmiento "asarmiento@sistemasamigables.com"
		 * @Date       Create: 2017-08-24
		 * @Time       Create: 3:19pm
		 * @Date       Update: 0000-00-00
		 * ---------------------------------------------------------------------
		 * @Description: Obtenemos la lista de los departamentos que puede tener
		 *             una iglesia para que los puedan elegir los que cada
		 *             iglesia utilizaria en su tesoreria.
		 * @Pasos      :
		 * ----------------------------------------------------------------------
		 * @return array
		 * ----------------------------------------------------------------------
		 */
		public function listDepartament()
		{
			return $this->listDepartamentRepository->listSelectsSinFilterChurch();
		}

		public function listDepartamentsSelect()
		{
			return ListDepartament::listsLabel();
		}

		
		/**
		 * -----------------------------------------------------------------------
		 * @Author     : Anwar Sarmiento <asarmiento@sistemasamigables.com>
		 * @DateCreate : 2017-08-30
		 * @TimeCreate : 12:01pm
		 * @DateUpdate : 0000-00-00
		 * -----------------------------------------------------------------------
		 * @description: Con este methodo eliminamos un departamento ligado a una
		 * iglesia siempre y cuando este recien creada
		 * @pasos      :
		 * ----------------------------------------------------------------------
		 * @param Request $request
		 * @var        ${TYPE_NAME}
		 * ----------------------------------------------------------------------
		 * @return \Illuminate\Http\JsonResponse
		 * ----------------------------------------------------------------------
		 * *
		 */
		public function remove(Request $request)
		{
			$departament = Departament::find($request->get('id'))->delete();
			if ($departament)
			{
				return response()->json([
					                        'message' => 'Se elimino con exito',
					                        'success' => true,
					                        'count'   => Departament::where('status', 'inactivo')->where('church_id',
					                                                                                     1)->sum('percent_of_budget')
				                        ], 200);
			}
			
			return response()->json(['errors' => ['El Departamento tiene cuentas de ingreso y salidas ligadas, no se pudo registrar']],
			                        422);
		}
		
		/**
		 * -----------------------------------------------------------------------
		 * @Author     : Anwar Sarmiento <asarmiento@sistemasamigables.com>
		 * @DateCreate : 2017-08-30
		 * @TimeCreate : 12:25pm
		 * @DateUpdate : 0000-00-00
		 * -----------------------------------------------------------------------
		 * @description: Aquí damos por finalizado la asignación de presupuesto a
		 * los departamentos y enviamos un email al primer anciano(a) y a la
		 * secretaria(o) para que aprueben o no la asignación de porcentajes digi-
		 * tados por el tesorero.
		 * @pasos      : 1. Cambiar de status para activo
		 * 2. enviar un email a primer anciano y secretaria
		 * 3. redireccionar a la lista de departamentos
		 * ----------------------------------------------------------------------
		 *
		 * @var        ${TYPE_NAME}
		 * ----------------------------------------------------------------------
		 * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
		 * ----------------------------------------------------------------------
		 *
		 */
		public function applied()
		{
			$depChurch = Departament::where('status', 'inactivo')->where('church_id',
			                                                             1);
			if ($depChurch->sum('percent_of_budget') == 100)
			{
				$depChurch->update(['status' => 'activo']);
				
				/** Queda Pendiente el envio de email para notificar */
				return response()->json(['url' => '/softadventist/lista-departament'],
				                        200);
			}
			
			return response()->json(['success' => false, 'errors' => 'Debe tener 100 distribuido entre todos los departamentos'],
			                        422);
		}
	}
