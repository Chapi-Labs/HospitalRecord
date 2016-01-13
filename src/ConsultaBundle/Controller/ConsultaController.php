<?php

namespace ConsultaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ConsultaBundle\Form\Type\ConsultaType as ConsultaForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Security("has_role('ROLE_USER')")
 */
class ConsultaController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ConsultaBundle:Default:index.html.twig', array('name' => $name));
    }

    public function consultarPacienteAction(Request $request)
    {
        $repositoryPaciente = $this->getDoctrine()->getRepository('AppBundle:Paciente');
        $cantidadPacientes = $repositoryPaciente
                ->createQueryBuilder('p')
                ->select('COUNT(p.id)')
                ->leftJoin('p.ingreso', 'ingreso')
                ->getQuery()
                ->getSingleScalarResult();

        $formConsultas = $this->createForm(
            new ConsultaForm()
        );

        $formConsultas->handleRequest($request);

        if (!$formConsultas->isValid()) {
            return $this->render(
                'ConsultaBundle:Consulta:consultaPaciente.html.twig',
                [
                    'form' => $formConsultas->createView(),
                    'pacientes' => null,
                    'contPacientes' => $cantidadPacientes,
                ]
            );
        }

        $dataForm = $formConsultas->getData();

        $pacientes = [];
        $qb = $repositoryPaciente->createQueryBuilder('p')
            ->leftJoin('p.ingreso', 'ingreso');
        
        if (isset($dataForm['consulta_dpi_nombre_apellidos'])) {
            $pacientes[] = $dataForm['consulta_dpi_nombre_apellidos'];

            return $this->render(
                'ConsultaBundle:Consulta:consultaPaciente.html.twig',
                [
                    'form' => $formConsultas->createView(),
                    'pacientes' => $pacientes,
                    'contPacientes' => $cantidadPacientes,
                ]
            );
        }

        if (isset($dataForm['consulta_expediente'])) {
            
            $pacientes[] = $dataForm['consulta_expediente'];

            return $this->render(
                'ConsultaBundle:Consulta:consultaPaciente.html.twig',
                [
                    'form' => $formConsultas->createView(),
                    'pacientes' => $pacientes,
                    'contPacientes' => $cantidadPacientes,
                ]
            );

        }

        if (isset($dataForm['consulta_fecha_inicio_ingreso'])) {
            $fechaInicio = $dataForm['consulta_fecha_inicio_ingreso']->format('Y-m-d');
            $fechaFin = $dataForm['consulta_fecha_fin_ingreso']->format('Y-m-d');

            $qb = $this->consultaPorFechas($qb, $fechaInicio, $fechaFin);
        }

        if (isset($dataForm['consulta_procedimiento_realizado'])) {
            $procedimiento = $dataForm['consulta_procedimiento_realizado'];

            $qb = $this->consultaPorProcedimiento($qb, $procedimiento);
        }

        if (isset($dataForm['consulta_clasificacion_ao'])) {
            $clasificacion = $dataForm['consulta_clasificacion_ao'];

            $qb = $this->consultaPorClasificacion($qb, $clasificacion);
        }

        if (isset($dataForm['consulta_edad'])) {
            $edadChoice = $dataForm['consulta_edad'];

            $qb = $this->consultarPorEdad($qb, $edadChoice);
        }

        if (isset($dataForm['consulta_sexo'])) {
            $sexo = $dataForm['consulta_sexo'];

            $qb
                ->andWhere('p.genero = :sexo')
                ->setParameter('sexo', $sexo);
        }

        $pacientes = $qb->getQuery()->getResult();

        if (isset($dataForm['consulta_diagnostico'])) {
            $diagnostico = $dataForm['consulta_diagnostico'];

            $pacientes = $this->consultaPorDiagnostico($pacientes, $diagnostico);
        }

        if (count($pacientes) < 1) {
            $this->get('braincrafted_bootstrap.flash')->alert('No se encontraron pacientes');
        }

        return $this->render(
            'ConsultaBundle:Consulta:consultaPaciente.html.twig',
            [
                'form' => $formConsultas->createView(),
                'pacientes' => $pacientes,
                'contPacientes' => $cantidadPacientes,
            ]
        );
    }

    private function consultaPorFechas($qb, $fechaInicio, $fechaFin)
    {
        return $qb
            ->andWhere('ingreso.fechaIngreso >= :fechaInicio')
            ->andWhere('ingreso.fechaIngreso < :fechaFin')
            ->setParameters([
                'fechaInicio' => $fechaInicio,
                'fechaFin' => $fechaFin,
            ]
        );
    }

    private function consultaPorProcedimiento($qb, $procedimiento)
    {
        return $qb
            ->andWhere('ingreso.procedimientoRealizado = :procedimiento')
            ->setParameter('procedimiento', $procedimiento);
    }

    private function consultaPorDiagnostico($pacientes, $diagnostico)
    {
        $returnPacientes = [];
        foreach ($pacientes as $paciente) {
            $ingresosPaciente = $paciente->getIngreso();
            foreach ($ingresosPaciente as $ingreso) {
                $diagnosticos = $ingreso->getArrayDiagnosticos();
                if (in_array($diagnostico, $diagnosticos)) {
                    $returnPacientes[] = $paciente;
                }
            }
        }

        return $returnPacientes;
    }

    private function consultaPorClasificacion($qb, $clasificacion)
    {
        return $qb
            ->andWhere('ingreso.clasificacionAO = :clasificacion')
            ->setParameter('clasificacion', $clasificacion);
    }

    private function consultarPorEdad($qb, $edadChoice)
    {
        if ($edadChoice === 'N') {
            $qb
                ->andWhere('p.edad >= 0')
                ->andWhere('p.edad < 13');
        } elseif ($edadChoice === 'A') {
            $qb
                ->andWhere('p.edad >= 13');
        }

        return $qb;
    }
}
